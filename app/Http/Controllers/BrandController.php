<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Brand;

class BrandController extends Controller
{
    //

    public function show(Request $request){
        $brands=Brand::latest();

        if(!empty($request->keyword)){
            $brands= $brands->where('name','like','%'.$request->get('keyword').'%');
        }
        $brands= $brands->paginate(5);
        return view('admin.brand.index',compact('brands'));

    }

    public function create(){
        return view('admin.brand.create');
    }

    
    public function store(Request $request){

      
       
        $validator= Validator::make($request->all(),[
            'name' =>'required',
            'slug' =>'required|unique:brands',
            'status'=>'required'
        ]);


        if ($validator->passes()){
           
            $brand=new Brand();
            $brand->name=$request->name;
            $brand->slug=$request->slug;
            $brand->status=$request->status;
            $brand->save();

            session()->flash('success','Brand added successfully');
            return response()->json([
                'status'=>true,
                'message' =>'Brand added successfully'
            ]);

        }
        else{
            return response()->json([
                'status'=>false,
                'errors' =>$validator->errors()
            ]);
        }
            
    }
    public function edit($id){
        $brand= Brand::findOrFail($id);

        return view('admin.brand.edit',compact('brand'));
        
    }
    public function update($id,Request $request){

        $brand= Brand::findOrFail($id);

        $validator= Validator::make($request->all(),[
            'name' =>'required',
            'slug' =>'required|unique:brands',
            'status'=>'required'
        ]);

        if(!empty($brand)){
            if ($validator->passes()){

          
                $brand->name=$request->name;
                $brand->slug=$request->slug;
                $brand->status=$request->status;
                $brand->update();
    
                session()->flash('success','brand updated successfully');
                return response()->json([
                    'status'=>true,
                    'message' =>'brand updated successfully'
                ]);
    
            }
            else{
                return response()->json([
                    'status'=>false,
                    'errors' =>$validator->errors()
                ]);
            }

        }


       
            
        
    }
    public function destroy($id){
        
        $brand= Brand::findOrFail($id);
        if(!empty($brand)){
            $brand->delete();
            session()->flash('success','brand deleted successfully');
            return response()->json([
                'status'=>true,
                'message' =>"brand deleted successfully"
            ]);
        }
      
}
}
