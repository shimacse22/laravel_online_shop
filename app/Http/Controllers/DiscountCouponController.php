<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DiscountCoupon;

use Illuminate\Support\Carbon;

use Illuminate\Support\Facades\Validator;

class DiscountCouponController extends Controller
{
    //

    public function index(Request $request){

        $discountCoupons=DiscountCoupon::latest();

        if(!empty($request->keyword)){
            $discountCoupons=$discountCoupons->where('name','like','%'.$request->get('keyword').'%');
        }
        $discountCoupons= $discountCoupons->paginate(2);
      

        return view('admin.discount.index',compact('discountCoupons'));

    }

    public function create(){
        return view('admin.discount.create');
    }

    public function store(Request $request){

        $validator= Validator::make($request->all(),[
                'code'=> 'required',
                'type'=> 'required',
                'discount_amount'=> ' required|numeric',
                'status' =>'required'

            ]);

            if( $validator->passes()){

                //starting date must be greater than current date
                if(!empty($request->starts_at)){
                    $current= Carbon::now();
                    $startsAt= Carbon::createFromFormat('Y-m-d H:i:s',$request->starts_at);
                    if( $startsAt->lte( $current)==true){
                        return response()->json([
                            'status'=>false,
                            'errors'=>['starts_at'=>'Start date can not be less then current date time'],
        
                        ]);
                    }
                }
               //expires date must be greater then start date
              if(!empty($request->expires_at) && !empty($request->starts_at)){
                $startsAt= Carbon::createFromFormat('Y-m-d H:i:s',$request->starts_at);
                $expiresAt= Carbon::createFromFormat('Y-m-d H:i:s',$request->expires_at);

                if($expiresAt->gt($startsAt)==false){
                    return response()->json([
                        'status'=>false,
                        'errors'=>['expires_at'=>'Expire date must be greater than Start date'],
    
                    ]);
                }

              }


                $discountCoupon=new DiscountCoupon;

                $discountCoupon->code= $request->code;
                $discountCoupon->name= $request->name;
                $discountCoupon->description= $request->description;
                $discountCoupon->type= $request->type;
                $discountCoupon->status= $request->status;
                $discountCoupon->max_uses= $request->max_uses;
                $discountCoupon->max_uses_user= $request->max_uses_user;
                $discountCoupon->discount_amount= $request->discount_amount;
                $discountCoupon->min_amount= $request->min_amount;
                $discountCoupon->status= $request->status;
                $discountCoupon->starts_at= $request->starts_at;
                $discountCoupon->expires_at= $request->expires_at;
                $discountCoupon->save();

              
              session()->flash('success','You have successfully added discount');
                return response()->json([
                    'status'=>true,
                    'message'=>'Discount added successfully',

                ]);
            }
            else{
                return response()->json([
                    'status'=>false,
                    'errors'=>$validator->errors(),

                ]);

            }
        
    }
    public function edit(Request $request, $id){

        $coupon=DiscountCoupon::find($id);

        if($coupon == null){

            session()->flash('error','Record not found');
            return redirect()->route('coupon.index');
        }

        return view('admin.discount.edit',compact('coupon'));
        
    }
    public function update(Request $request, $id){

        $discountCoupon=DiscountCoupon::find($id);

        $validator= Validator::make($request->all(),[
            'code'=> 'required',
            'type'=> 'required',
            'discount_amount'=> ' required|numeric',
            'status' =>'required'

        ]);

        if( $validator->passes()){

            //starting date must be greater than current date
            if(!empty($request->starts_at)){
                $current= Carbon::now();
                $startsAt= Carbon::createFromFormat('Y-m-d H:i:s',$request->starts_at);
                if( $startsAt->lte( $current)==true){
                    return response()->json([
                        'status'=>false,
                        'errors'=>['starts_at'=>'Start date can not be less then current date time'],
    
                    ]);
                }
            }
           //expires date must be greater then start date
          if(!empty($request->expires_at) && !empty($request->starts_at)){
            $startsAt= Carbon::createFromFormat('Y-m-d H:i:s',$request->starts_at);
            $expiresAt= Carbon::createFromFormat('Y-m-d H:i:s',$request->expires_at);

            if($expiresAt->gt($startsAt)==false){
                return response()->json([
                    'status'=>false,
                    'errors'=>['expires_at'=>'Expire date must be greater than Start date'],

                ]);
            }

          }


          

            $discountCoupon->code= $request->code;
            $discountCoupon->name= $request->name;
            $discountCoupon->description= $request->description;
            $discountCoupon->type= $request->type;
            $discountCoupon->status= $request->status;
            $discountCoupon->max_uses= $request->max_uses;
            $discountCoupon->max_uses_user= $request->max_uses_user;
            $discountCoupon->discount_amount= $request->discount_amount;
            $discountCoupon->min_amount= $request->min_amount;
            $discountCoupon->status= $request->status;
            $discountCoupon->starts_at= $request->starts_at;
            $discountCoupon->expires_at= $request->expires_at;
            $discountCoupon->update();

          
          session()->flash('success','You have successfully updated discount Coupon');
            return response()->json([
                'status'=>true,
                'message'=>'Discount updated successfully',

            ]);
        }
        else{
            return response()->json([
                'status'=>false,
                'errors'=>$validator->errors(),

            ]);

        }
    
        
    }

    public function delete($id){

        $coupon=DiscountCoupon::find($id);

        if($coupon ==null){
            session()->flash('error','Record Not Found');
            return response()->json([
                'status'=>false
             

            ]);

        }
       

        $coupon->delete();
        
        session()->flash('success','You have successfully deleted discount Coupon');
        return response()->json([
            'status'=>true,
            'message'=>'Discount Deleted successfully',

        ]);
        
    }
}
