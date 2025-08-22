<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\ShippingCharge;


use Illuminate\Support\Facades\Validator;

class ShippingController extends Controller
{
    //

    public function create(){
        $countries=Country::orderBy('name','ASC')->get();
        $shippingCharges=ShippingCharge::select('shipping_charges.*','countries.name')
        ->leftJoin('countries','countries.id','shipping_charges.country_id')->get();
        $data['shippingCharges']=  $shippingCharges;
        $data['countries']=$countries;
        return view('admin.shipping.create',$data);
    }

    public function store(Request $request){
        $validator= Validator::make($request->all(),[
            'country'=>'required',
            'amount'=>'required|numeric'
        ]);

        if($validator->passes()){
            $count=ShippingCharge::where('country_id',$request->country)->count();

            if($count >0){

                session()->flash('error','You have already add shipping charge for this country .');
                return response()->json([
                    'status'=>true,
                  
                    
                ]);

            }

            $shippingCharges=new ShippingCharge;

            $shippingCharges->country_id= $request->country;
            $shippingCharges->amount= $request->amount;
            $shippingCharges->save();
            session()->flash('success','You have successfully add shipping charge .');
            return response()->json([
                'status'=>true,
               

            ]);

        }
        else{
            return response()->json([
                'status'=>false,
                'errors'=>$validator->errors()

            ]);
        }
    }

    public function edit($id){
        $shippingCharge=ShippingCharge::find($id);
        $countries=Country::get();
        $shippingCharges=ShippingCharge::select('shipping_charges.*','countries.name')
        ->leftJoin('countries','countries.id','shipping_charges.country_id')->get();

        $data['shippingCharges']=  $shippingCharges;
        $data['shippingCharge']=$shippingCharge;
        $data['countries']= $countries;
        return view('admin.shipping.edit', $data);
    }

    public function update($id,Request $request){
        $shippingCharge=ShippingCharge::find($id);

        $validator= Validator::make($request->all(),[
            'country'=>'required',
            'amount'=>'required|numeric'
        ]);

        if($validator->passes()){
          

            $shippingCharge->country_id= $request->country;
            $shippingCharge->amount= $request->amount;
            $shippingCharge->save();
            session()->flash('success','You have successfully update shipping Charge .');
            return response()->json([
                'status'=>true,
               

            ]);

        }
        else{
            return response()->json([
                'status'=>false,
                'errors'=>$validator->errors()

            ]);
        }


    }
    public function delete($id){
        $shippingCharge=ShippingCharge::find($id);
        if($shippingCharge==null){
            session()->flash('error','Record not found.');
            return response()->json([
                'status'=>false,
               
    
            ]);
    
        }
        $shippingCharge->delete();
        session()->flash('success','You have successfully delete shipping charges .');
        return response()->json([
            'status'=>true,
           

        ]);

    }
}
