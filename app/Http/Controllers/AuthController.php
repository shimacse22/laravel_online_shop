<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Wishlist;
use App\Models\Country;
use App\Models\CustomerAddress;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPasswordEmail;


class AuthController extends Controller
{
    //
    public function login(){
        return view('frontend.account.login');
    }

   
    public function register(){
        return view('frontend.account.register');
    }

    public function store(Request $request){
        $validator=Validator::make($request->all(),[
            'name'=>'required|min:4',
            'email'=>'required|email|unique:users',
            'phone'=>'required|max:11',
            'password'=>'required|min:5|confirmed'
        ]);

        if($validator->passes()){
            $user=new User;
            $user->name=$request->name;
            $user->email=$request->email;
            $user->phone=$request->phone;
            $user->role=$request->role;
            $user->password=Hash::make($request->password);

            $user->save();
            Session()->flash('success','You Have been registered successfully');

            return response()->json([
                'status'=>true,
              

            ]);
            return redirect()->route('account.login');

        }
        else{
            return response()->json([
                'status'=>false,
                'errors'=>$validator->errors()

            ]);
        }

    }
    public function authenticate(Request $request){
        $validator=Validator::make($request->all(),[
           
            'email'=>'required|email',
            'password'=>'required'
        ]);

        if( $validator->passes()){
            if(Auth::attempt(['email' =>  $request->email, 'password' => $request->password],$request->get('remember'))){
                if(session()->has('url.intended')){
                    return redirect(session()->get('url.intended'));
                }
                return redirect()->route('account.profile');
            }
            else{
               // session()->flash('error','email or password is incorrect');
                return redirect()->route('account.login')
                ->withInput($request->only('email'))
                ->with('error','email or password is incorrect');
                
            }
        }
        else{
            return redirect()->route('account.login')
            ->withErrors($validator)
            ->withInput($request->only('email'));
           
          
           

        }
    }

    public function profile(){
        $userId=Auth::user()->id;
        $countries=Country::orderBy('name','ASC')->get();
        $address=CustomerAddress::where('user_id',$userId)->first();
        $users=User::where('id',$userId)->first();
        return view('frontend.account.profile',compact('users','countries','address'));
    }

    public function profileUpdate(Request $request){
        $userId=Auth::user()->id;
        $validator=Validator::make($request->all(),[
          
            'name'=>'required',
            'email'=>'required|email|unique:users,email,'.$userId.',id',
            'phone'=>'required'

        ]);

        if($validator->passes()){

            $user=User::find($userId);

            $user->name=$request->name;
            $user->email=$request->email;
            $user->phone=$request->phone;
            $user->save();

            session()->flash('success','Profile Updated Successfully');
            return response()->json([
                'status'=>true,
                'message'=>'Profile Updated Successfully',

            ]);

        }

        else{
            return response()->json([
                'status'=>false,
                'errors'=>$validator->errors(),

            ]);
          
        }
    }

    public function addressUpdate(Request $request){
        $userId=Auth::user()->id;
        $validator=Validator::make($request->all(),[
            'first_name'=>'required|min:3',
            'last_name'=>'required',
            'email'=>'required|email',
            'country_id'=>'required',
            'mobile'=>'required',
            'address'=>'required',
            'city'=>'required',
            'state'=>'required',
            'zip'=>'required',
               
        ]);

        if($validator->passes()){

            // $user=User::find($userId);

            // $user->name=$request->name;
            // $user->email=$request->email;
            // $user->phone=$request->phone;
            // $user->save();

            CustomerAddress::updateOrCreate(
                ['user_id'=> $userId],
                [
                    'user_id'=> $userId,
                    'first_name'=>$request->first_name,
                    'last_name'=>$request->last_name,
                    'mobile'=>$request->mobile,
                    'email'=>$request->email,
                    'country_id'=>$request->country_id,
                    'address'=>$request->address,
                    'city'=>$request->city,
                    'state'=>$request->state,
                    'zip'=>$request->zip,
                    'apartment'=>$request->apartment,
                    'notes'=>$request->order_notes
                   
                ]
            
             );

            session()->flash('success','Address Updated Successfully');
            return response()->json([
                'status'=>true,
                'message'=>'Address Updated Successfully',

            ]);

        }

        else{
            return response()->json([
                'status'=>false,
                'errors'=>$validator->errors(),

            ]);
          
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('account.login')
        ->with('success','You have logout successfully');
    }

    public function orders(){

        $user=Auth::user();

        $orders=Order::where('user_id',$user->id)->orderBy('created_at','DESC')->get();

        $data['orders']= $orders;

       // dd( $data);

        return view('frontend.account.order',$data);
    }
    public function orderDetail($id){
        $data=[];

        $user=Auth::user();
        $order=Order::where('user_id',$user->id)->where('id',$id)->first();
        $orderItems=OrderItem::where('order_id',$id)->get();
        $orderItemsCount=OrderItem::where('order_id',$id)->count()->get();
        $data['order']=$order;
        $data['orderItemsCount']=$orderItemsCount;
        $data['orderItems']= $orderItems;
        return view('frontend.account.order-details',$data);

    }
    public function wishlist(){
        $wishlists=Wishlist::where('user_id',Auth::user()->id)->with('product')->get();
      //  dd($wishlists);
        $data=[];
        $data['wishlists']=$wishlists;
        return view('frontend.account.wishlist',$data);
    }

    public function removeWishlistProduct(Request $request){
        $wishlist=Wishlist::where('user_id',Auth::user()->id)->where('product_id',$request->id)->first();

        if($wishlist==null){

            session()->flash('error','Product already Removed');
            return response()->json([
                'status'=>true

            ]);
        }
        $wishlist->delete();
        session()->flash('success','Product successfully removed from wishlist');
        return response()->json([
            'status'=>true

        ]);

    }
    public function changePassword(){
        return view('frontend.account.change-password');
    }

    public function processChangePassword(Request $request){
       

        $validator=Validator::make($request->all(),[
            'old_password'=>'required',
            'new_password'=>'required|min:5',
            'confirm_password'=>'required|same:new_password'

        ]);

        if($validator->passes()){
            $user= User::select('id','password')->where('id',Auth::user()->id)->first();

            if(!Hash::check($request->old_password,$user->password)){
            session()->flash('error','Your Old Password is not match,please try again');
            return response()->json([
                'status'=>true,
            
            ]);

            }

            User::where('id',$user->id)->update([
                'password'=> Hash::make($request->new_password)
            ]);

            session()->flash('success','Password Updated Successfully');
            return response()->json([
                'status'=>true,
                'message'=>'Password Updated Successfully'

            ]);

        }
        else{
            return response()->json([
                'status'=>false,
                'errors'=>$validator->errors(),
    
            ]);
        }
    }

    public function forgotPassword(){
        return view('frontend.account.forgot-password');
    }

    public function processForgotPassword(Request $request){

        $validator=Validator::make($request->all(),[
            'email'=>'required|email|exists:users,email'

        ]);

        if($validator->fails()){

            return redirect()->route('account.forgotPassword')->withInput()->withErrors(  $validator);

        }

        $token=Str::random(60);

        DB::table('password_reset_tokens')->where('email',$request->email)->delete();

        DB::table('password_reset_tokens')->insert([
            'token'=>$token,
            'email'=>$request->email,
            'created_at'=>now(),
        ]);

        //send Email Here

        $user=User::where('email',$request->email)->first();

        $formData=[
            'token'=>$token,
            'user'=>$user,
            'mailSubject'=>'You have requested to reset password'

        ];

        Mail::to($request->email)->send(new ResetPasswordEmail( $formData));

        return redirect()->route('front.forgotPassword')->with('success','Please check your inbox to reset password');

    }

    public function resetPassword($token){
        $tokenObj=  DB::table('password_reset_tokens')->where('token', $token)->first();

        if($tokenObj==null){
           
            return redirect()->route('front.forgotPassword')->with('error','invalid request'); 
        }

        return view('frontend.account.reset-password',[
            'token'=>$token
        ]);

    }

    public function processResetPassword(Request $request){

        $token=$request->token;
        $tokenObj=  DB::table('password_reset_tokens')->where('token', $token)->first();

        DB::table('password_reset_tokens')->where('email',$request->email)->delete();

        if($tokenObj==null){
           
        return redirect()->route('front.forgotPassword')->with('error','invalid request'); 
        }

        $validator=Validator::make($request->all(),[
            'new_password'=>'required|min:5',
            'confirm_password'=>'required|same:new_password'

        ]);
        $user=User::where('email',$tokenObj->email)->first();

        if($validator->fails()){

            return redirect()->route('front.resetPassword',$token)->withInput()->withErrors( $validator);

        }

       User::where('id',$user->id)->update([
            'password'=> Hash::make($request->new_password)
       ]);


       return redirect()->route('account.login')->with('success','You have successfully updated your password'); 
        

    }
}
