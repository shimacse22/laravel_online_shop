<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\TempImage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    //
    public function index(){
        $totalOrder=Order::where('status','!=','canceled')->count();
        $totalProduct=Product::count();
        $totalCustomer=User::where('role','user')->count();
        $totalSale=Order::where('status','!=','canceled')->sum('grand_total');

        //Revenue this month
        $startOfMonth=Carbon::now()->startOfMonth()->format('Y-m-d');
        $currentDate=Carbon::now()->format('Y-m-d');

        $totalRevenueThisMonth=Order::where('status','!=','canceled')
        ->whereDate('created_at','>=',$startOfMonth)
        ->whereDate('created_at','<=', $currentDate)
        ->sum('grand_total');

        //Revenue Last Month
        $lastMonthStartDate=Carbon::now()->subMonth()->startOfMonth()->format('Y-m-d');
        $lastMonthEndDate=Carbon::now()->subMonth()->endOfMonth()->format('Y-m-d');

        $lastMonthName=Carbon::now()->subMonth()->startOfMonth()->format('M');

        $totalRevenueLastMonth=Order::where('status','!=','canceled')
        ->whereDate('created_at','>=',$lastMonthStartDate)
        ->whereDate('created_at','<=', $lastMonthEndDate)
        ->sum('grand_total');

        //Revenue last thirty Days

        $lastThirtyDaysStartDate=Carbon::now()->subDays(30)->format('Y-m-d');
       

        $totalRevenueLastThirtyDays=Order::where('status','!=','canceled')
        ->whereDate('created_at','>=',$lastThirtyDaysStartDate)
        ->whereDate('created_at','<=',  $currentDate)
        ->sum('grand_total');

        //Temp-image delete here
        $dayBeforeToday=Carbon::now()->subDays(1)->format('Y-m-d H:i:s');
        $tempImages=TempImage::where('created_at','<=', $dayBeforeToday)->get();

        foreach( $tempImages as $tempImage){
            $path=public_path('/upload/Temp-image/'.$tempImage->name);
            $thumbPath=public_path('/upload/Temp-image/thumb/'.$tempImage->name);

            //Main Image delete here

            if(File::exists( $path)){

                File::delete($path);
            }

            //thumb Image delete here

            
            if(File::exists($thumbPath)){

                File::delete($thumbPath);
            }


            TempImage::where('id',$tempImage->id)->delete();

        }

        return view('admin.dashboard',[
            'totalOrder'=> $totalOrder,
            'totalCustomer'=> $totalCustomer,
            'totalProduct'=>$totalProduct,
            'totalSale'=>$totalSale,
            'totalRevenueThisMonth'=>$totalRevenueThisMonth,
            'totalRevenueLastMonth'=>$totalRevenueLastMonth,
            'totalRevenueLastThirtyDays'=>$totalRevenueLastThirtyDays,
            'lastMonthName'=> $lastMonthName,


        ]);
    }

    public function login(){
        return view('admin.login');
    }

    public function register(){
        return view('admin.register');
    }

    public function store(Request $request){
        $validator=Validator::make($request->all(),[
            'name'=>'required|min:4',
            'email'=>'required|email|unique:users',
            'phone'=>'required|max:11',
            'password'=>'required|min:5|confirmed',
           
        ]);

        if($validator->passes()){
            $user=new User;
            $user->name=$request->name;
            $user->email=$request->email;
            $user->phone=$request->phone;
           // $user->role=$request->role;
            $user->password=Hash::make($request->password);

            $user->save();
            Session()->flash('success','You Have been registered successfully');

            return response()->json([
                'status'=>true,
                'message'=>'You Have been registered successfully',
              

            ]);
            return redirect()->route('admin.login');

        }
        else{
            return response()->json([
                'status'=>false,
                'errors'=>$validator->errors()

            ]);
        }

    }
   
    public function logout( Request $request){
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
       
    }

    public function changePassword(){
        return view('admin.change-password');
    }

    public function updatePassword(Request $request){
      $validator= Validator::make($request->all(),[
        'old_password' => 'required',
        'new_password' =>'required|min:8',
        'confirm_password' =>'required|same:new_password'

      ]);

      if($validator->passes()){
        if(!Hash::check($request->old_password,Auth::user()->password)){
            session()->flash('error','your old password is not match, please try again ');
            return response()->json([
                'status' =>'true',
                'message'=>'your old password is not match, please try again',
                
            ]);
        }
        User::whereId(Auth::user()->id)->update([
            'password'=> Hash::make($request->new_password)
        ]);
        session()->flash('success','You have successfully change your password ');
        return response()->json([
            'status' =>'true',
            'message'=>'You have successfully change your password'
            
        ]);

     
      }

      else{
        return response()->json([
            'status' =>'false',
            'errors'=>$validator->errors()
        ]);
      }
    }
}
