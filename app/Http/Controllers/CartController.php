<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Country;
use App\Models\Order;
use App\Models\CustomerAddress;
use App\Models\OrderItem;
use App\Models\ShippingCharge;
use App\Models\DiscountCoupon;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\DB;
use Stripe\Stripe;
use Stripe\PaymentIntent;


class CartController extends Controller
{
    //

    public function addToCart(Request $request){

        $product=Product::with('product_images')->find($request->id);
        if($product==null){
            return response()->json([
                'status'=>false,
                'message'=>'product not found'

            ]);
        }

        if(Cart::count() >0){
           // echo "product already in cart";

           $cartContent=Cart::content();
           $productAlreadyExits=false;
           foreach($cartContent as $item){
            if($item->id==$product->id){
                $productAlreadyExits=true;
            }
           }
           if( $productAlreadyExits==false){

            Cart::add($product->id,$product->title, 1, $product->price,['productImage'=>(!empty($product->product_images))?$product->product_images->first(): '']);
            $status=true;
            $message='<strong>'.$product->title.'</strong> added in cart successfully';
            session()->flash('success',  $message);

           }
           else{
            $status=false;
            $message=$product->title.' already added in cart';
           }

        }
        else{

          //  echo "product is not in cart";
            //cart is empty

            Cart::add($product->id,$product->title, 1, $product->price,['productImage'=>(!empty($product->product_images))?$product->product_images->first(): '']);
            $status=true;
            $message='<strong>'.$product->title.'</strong> added in cart successfully';
            session()->flash('success',  $message);

           
        }
        return response()->json([
            'status'=> $status,
            'message'=>$message

        ]);
       
    }

    public function cart(){
        //dd( Cart::content());
       
        $cartContent=Cart::content();
        return view('frontend.cart',compact('cartContent'));
    }

    public function updateCart(Request $request){
        $rowId=$request->rowId;
        $qty=$request->qty;
        $itemInfo=Cart::get($rowId);

        $product=Product::find($itemInfo->id);

        if($product->track_qty=="Yes"){
            if( $qty <= $product->qty){
                Cart::update($rowId,$qty);
                $message= "Cart updated successfully";
                $status=true;

            }
            else{
                $message="Requested qty ($qty) is not available in stock";
                $status=false;
                session()->flash('error', $message);
            }
        }
        else{
            Cart::update($rowId,$qty);
            $message= "Cart updated successfully";
            $status=true;
            session()->flash('success', $message);
        }
     
     

       return response()->json([
        'status'=>$status,
        'message'=>$message

       ]);
    }

    public function deleteCart(Request $request){
        $rowId=$request->rowId;
        $itemInfo=Cart::get($rowId);

        if($itemInfo==null){
            $errorMessage="Item not found in cart ";
            session()->flash('error',  $errorMessage);

            return response()->json([
                'status'=>false,
                'message'=>$errorMessage
        
               ]);

        }

        Cart::remove( $rowId);
        $message="Item removed from cart successfully ";
        session()->flash('success',  $message);

        return response()->json([
            'status'=>true,
            'message'=>$message
    
           ]);


    }

    public function checkout(){
        $discount=0;
        $subtotal=Cart::subtotal(2,'.','');
        if(Cart::count()==0){
            return redirect()->route('front.cart');
        }

          //Apply discount here

          if(session()->has('code')){

            $code=session()->get('code');

            if($code->type=="percent"){
                $discount=($code->discount_amount/100)* $subtotal;
            }
            else{
                $discount=$code->discount_amount;
            }
        }

        if(Auth::check()==false){

            if(!session()->has('url.intended')){
                session(['url.intended'=>url()->current()]);
            }
           
            return redirect()->route('account.login');
        }

        $user=Auth::user();
        $customerAddress=CustomerAddress::where('user_id',$user->id)->first();

        session()->forget('url.intended');
        $countries= Country::orderBy('name','ASC')->get();
        //Calculate shipping here
       
        if($customerAddress !=null){
            $userCountry=  $customerAddress->country_id;
            $shippingInfo=ShippingCharge::where('country_id', $userCountry)->first();

            $totalQty=0;
            $totalShippingCharge=0;
            $grandTotal=0;
            foreach(Cart::content() as $item){
                $totalQty +=$item->qty;
            }
        //check total shipping charge

            $totalShippingCharge=$totalQty*$shippingInfo->amount;
            $grandTotal=($subtotal-$discount)+$totalShippingCharge;

        }
        else{
          
    
           $totalShippingCharge=0;
           $grandTotal=($subtotal-$discount)+$totalShippingCharge;

        }

        //check total product qty
        

       return view('frontend.checkout',compact('countries','customerAddress','totalShippingCharge','grandTotal','discount'));
    }

    public function processCheckout(Request $request){
        $validator=Validator::make($request->all(),[
            'first_name'=>'required|min:3',
            'last_name'=>'required',
            'email'=>'required|email',
            'country'=>'required',
            'mobile'=>'required',
            'address'=>'required',
            'city'=>'required',
            'state'=>'required',
            'zip'=>'required',
               
        ]);

        if($validator->fails()){
            return response()->json([
                'status'=>false,
                'message'=>'please fix the errors',
                'errors'=>$validator->errors()
            ]);
        }

 //user address save

 $user= Auth::user();
 CustomerAddress::updateOrCreate(
    ['user_id'=>$user->id],
    [
        'user_id'=>$user->id,
        'first_name'=>$request->first_name,
        'last_name'=>$request->last_name,
        'mobile'=>$request->mobile,
        'email'=>$request->email,
        'country_id'=>$request->country,
        'address'=>$request->address,
        'city'=>$request->city,
        'state'=>$request->state,
        'zip'=>$request->zip,
        'apartment'=>$request->apartment,
        'notes'=>$request->order_notes
       
    ]

 );

 //store data in order table
    if($request->payment_method=='cod'){
        $couponCode="";
        $couponCodeId=null;
        $subTotal= Cart::subtotal(2,'.','');
        $shipping=0;
        $discount=0;
       

        //Apply discount here

        if(session()->has('code')){

            $code=session()->get('code');

            if($code->type=="percent"){
                $discount=($code->discount_amount/100)* $subTotal;
            }
            else{
                $discount=$code->discount_amount;
            }

            $couponCode=$code->code;
            $couponCodeId=$code->id;

        }

       // search shipping amount from database

        $shippingInfo=ShippingCharge::where('country_id',$request->country)->first();

           
        $totalQty=0;
        foreach(Cart::content() as $item){
            $totalQty +=$item->qty;
        }
        //check if select country is match with database shipping_charges table or not
        if($shippingInfo !=null){

            //check total shipping charge
    
            $shipping=$totalQty*$shippingInfo->amount;
            $grandTotal=($subTotal-$discount)+$shipping;

        }
        else{
            $shippingInfo=ShippingCharge::where('country_id','rest_of_world')->first();

           
            //check total shipping charge
    
            $shipping=$totalQty*$shippingInfo->amount;
            $grandTotal=($subTotal-$discount)+$shipping;
 
            

        }
        $order= new order;

        $order->subtotal=$subTotal;
        $order->grand_total=$grandTotal;
        $order->shipping=$shipping;
        $order->discount=$discount;
        $order->coupon_code=$couponCode;
        $order->coupon_code_id=$couponCodeId;
        $order->payment_status='not paid';
        $order->status='pending';
        $order->user_id=$user->id;
        $order->first_name=$request->first_name;
        $order->last_name=$request->last_name;
        $order->mobile=$request->mobile;
        $order->email=$request->email;
        $order->country_id=$request->country;
        $order->address=$request->address;
        $order->city=$request->city;
        $order->state=$request->state;
        $order->zip=$request->zip;
        $order->apartment=$request->apartment;
        $order->notes=$request->order_notes;
        $order->save();


       

        // store order item in order_items table

    foreach(Cart::content() as $item ){
        $orderItem= new OrderItem;

        $orderItem->order_id=$order->id;
        $orderItem->product_id=$item->id;
        $orderItem->name=$item->name;
        $orderItem->qty=$item->qty;
        $orderItem->price=$item->price;
        $orderItem->total=$item->price*$item->qty;
        $orderItem->save();

         //send order email

         orderEmail($order->id,'customer');

        //Update product Stock

        $productData=Product::find($item->id);

        if( $productData->track_qty=='Yes'){
            $currentQty=$productData->qty;
            $updateQty= $currentQty-$item->qty;
            $productData->qty=$updateQty;
            $productData->save();

        }

    }
    Cart::destroy();
    session()->forget('code');
    session()->flash('success','You have successfully place your order.');
    return response()->json([
        'status'=>true,
        'orderId'=>$order->id,
        'message'=>'Order saved Successfully',
       
    ]);


    }
    elseif($request->payment_method=='stripe') {
        // Validate if stripeToken is present
    if (!$request->has('stripeToken')) {
        return response()->json([
            'status' => false,
            'message' => 'Stripe token is missing. Please try again.',
        ], 400);
    }

    // Calculate Order Total
     $couponCode="";
     $couponCodeId=null;
     $subTotal= Cart::subtotal(2,'.','');
     $shipping=0;
     $discount=0;
    

     //Apply discount here

     if(session()->has('code')){

         $code=session()->get('code');

         if($code->type=="percent"){
             $discount=($code->discount_amount/100)* $subTotal;
         }
         else{
             $discount=$code->discount_amount;
         }

         $couponCode=$code->code;
         $couponCodeId=$code->id;

     }

    // search shipping amount from database

     $shippingInfo=ShippingCharge::where('country_id',$request->country)->first();

        
     $totalQty=0;
     foreach(Cart::content() as $item){
         $totalQty +=$item->qty;
     }
     //check if select country is match with database shipping_charges table or not
     if($shippingInfo !=null){

         //check total shipping charge
 
         $shipping=$totalQty*$shippingInfo->amount;
         $grandTotal=($subTotal-$discount)+$shipping;

     }
     else{
         $shippingInfo=ShippingCharge::where('country_id','rest_of_world')->first();

        
         //check total shipping charge
 
         $shipping=$totalQty*$shippingInfo->amount;
         $grandTotal=($subTotal-$discount)+$shipping;

         

     }

    // Create Order
    $order = Order::create([
        'subtotal' => $subTotal,
        'grand_total' => $grandTotal,
        'shipping' => $shipping,
        'discount' => $discount,
        'coupon_code' => $couponCode,
        'coupon_code_id' => $couponCodeId,
        'payment_status' => 'not paid',
        'status' => 'pending',
        'user_id' => Auth::id(),
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'mobile' => $request->mobile,
        'email' => $request->email,
        'country_id' => $request->country,
        'address' => $request->address,
        'city' => $request->city,
        'state' => $request->state,
        'zip' => $request->zip,
        'apartment' => $request->apartment,
        'notes' => $request->order_notes,
    ]);

    // Store Order Items
    foreach (Cart::content() as $item) {
        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $item->id,
            'name' => $item->name,
            'qty' => $item->qty,
            'price' => $item->price,
            'total' => $item->price * $item->qty,
        ]);
    }

    // Process Stripe Payment
    \Stripe\Stripe::setApiKey(env("STRIPE_SECRET"));

    try {
        $charge = \Stripe\Charge::create([
            'amount' => $grandTotal * 100, // Convert to cents
            'currency' => 'usd',
            'source' => $request->stripeToken,
            'metadata' => [
                'order_id' => $order->id,
            ],
            'description' => "Order #{$order->id} from Laravel eCommerce",
        ]);

        // Update order payment status
        $order->update(['payment_status' => 'paid']);

        // Clear cart & session
        Cart::destroy();
        session()->forget('code');

        return response()->json([
            'status' => true,
            'orderId' => $order->id,
            'message' => 'Payment successful. Your order has been placed!',
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => false,
            'message' => 'Payment failed: ' . $e->getMessage(),
        ]);
    }
    }



   


    }

    public function thankYou($id){
        $id=$id;
        return view('frontend.thankyou',compact('id'));
    }

    public function getOrderSummary(Request $request){
        //check any country select or not in country field
        $subtotal=Cart::subtotal(2,'.','');

        $discount=0;
        $discountString="";
        //Apply discount here

        if(session()->has('code')){

            $code=session()->get('code');

            if($code->type=="percent"){
                $discount=($code->discount_amount/100)* $subtotal;
            }
            else{
                $discount=$code->discount_amount;
            }

            $discountString='<div class="input-group mt-4" id="discount_response">
                            <strong>'.session()->get('code')->code.'</strong>
                            <a class="btn btn-sm btn-danger" id="remove_discount"><i class="fa fa-times"></i></a>
                            </div>';
        }
      
        if($request->country_id > 0){
            $shippingInfo=ShippingCharge::where('country_id',$request->country_id)->first();

           
            $totalQty=0;
            foreach(Cart::content() as $item){
                $totalQty +=$item->qty;
            }
            //check if select country is match with database shipping_charges table or not
            if($shippingInfo !=null){

                //check total shipping charge
        
               $totalShippingCharge=$totalQty*$shippingInfo->amount;

               //calculate grand total
               $grandTotal= ($subtotal-$discount)+$totalShippingCharge;

                return response()->json([
                    'status'=>true,
                    'discount'=>number_format($discount,2),
                    'discountString'=> $discountString,
                    'totalShippingCharge'=>number_format($totalShippingCharge,2),
                    'grandTotal'=>number_format($grandTotal,2),

                ]);

            }
            else{
                $shippingInfo=ShippingCharge::where('country_id','rest_of_world')->first();

               
                //check total shipping charge
        
               $totalShippingCharge=$totalQty*$shippingInfo->amount;
               $grandTotal=($subtotal-$discount)+$totalShippingCharge;
                return response()->json([
                    'status'=>true,
                    'discount'=>number_format($discount,2),
                    'discountString'=> $discountString,
                    'totalShippingCharge'=>number_format($totalShippingCharge,2),
                    'grandTotal'=> number_format($grandTotal,2),

                ]);

            }

        }
    
        else{
          
           
            return response()->json([
                'status'=>true,
                'discount'=>number_format($discount,2),
                'discountString'=> $discountString,
                'totalShippingCharge'=>number_format(0,2),
                'grandTotal'=> number_format(($subtotal-$discount),2),

            ]);
        }

    }

    public function applyDiscount(Request $request){

        $code=DiscountCoupon::where('code',$request->code)->first();

        //if coupon not exists in database

        if($code==null){
            return response()->json([
                'status'=>false,
                'message'=>'Invalid discount Coupon'

            ]);
        }
    //For current date and time
        $now=Carbon::now();

        if($code->starts_at !=""){
            $startDate=Carbon::createFromFormat('Y-m-d H:i:s',$code->starts_at );

            if($now->gt($startDate)){

                return response()->json([
                    'status'=>false,
                    'message'=>'Invalid Coupon start date'
    
                ]);

            }
        }

        if($code->expires_at !=""){
            $endDate=Carbon::createFromFormat('Y-m-d H:i:s',$code->expires_at );

            if($now->gt($endDate)){

                return response()->json([
                    'status'=>false,
                    'message'=>'Invalid Coupon end date'
    
                ]);

            }
        }
        
        // minimum amount check

        $subtotal=Cart::subtotal(2,'.','');
        if($code->min_amount > 0){
            if( $subtotal < $code->min_amount){
                return response()->json([
                    'status'=>false,
                    'message'=>'Minimum amount must be $'.$code->min_amount.'.',
    
                ]);
            }
        }

        if($code->max_uses>0){
              //for max uses
            $couponUses=Order::where('coupon_code_id',$code->id)->count();

            if($couponUses >= $code->max_uses){
                return response()->json([
                    'status'=>false,
                    'message'=>' this coupon maximum use one time'

                ]);

            }
        }

        if($code->max_uses_user>0){
              // for max uses user
            $couponUsesUser=Order::where(['coupon_code_id'=>$code->id,'user_id'=> Auth::user()->id])->count();

            if($couponUsesUser >= $code->max_uses_user){
                return response()->json([
                    'status'=>false,
                    'message'=>'You have already use this coupon'

                ]);

            }

        }
      
      

        session()->put('code',$code);

        return $this->getOrderSummary($request);
     



    }

    public function removeCoupon(Request $request){

        session()->forget('code');
        return $this->getOrderSummary($request);

        
        return response()->json([
            'status'=>true,
            'message'=>'Discount Coupon deleted successfully'

        ]);

    }

    //Payment Gateway

    public function paymentGateway(){
        $aamarpay= DB::table('payment_gatway')->first();
        $surjopay= DB::table('payment_gatway')->skip(1)->first();
        $sslcommerz= DB::table('payment_gatway')->skip(2)->first();

        return view('admin.payment_gateway.edit',compact('aamarpay','surjopay','sslcommerz'));
    }

    public function updateAamarpay(Request $request){
        $data=array();
        $data['store_id']=$request->store_id;
        $data['signature_key']=$request->signature_key;
        $data['status']=$request->status;
        DB::table('payment_gatway')->where('id',$request->id)->update($data);
        return redirect()->back()->with('success','Aamarpay Update successfully');
    
    }
    
}