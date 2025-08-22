<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Subcategory;
use App\Models\Category;

class SubCategoryController extends Controller
{
    //

    public function index(Request $request){
        $subcategories=Subcategory::latest();

        if(!empty($request->keyword)){
            $subcategories=  $subcategories->where('name','like','%'.$request->get('keyword').'%');
        }
        $subcategories=$subcategories->paginate(5);
        return view('admin.subcategory.index',compact('subcategories'));
    }
    public function create(){
        $categories= Category::orderBy('category_name','ASC')->get();
       
        return view('admin.subcategory.create',compact('categories'));
    }
    public function store(Request $request){

          $validator= Validator::make($request->all(),[
            'name' =>'required',
            'slug' =>'required|unique:subcategories',
        ]);

        if($validator->passes()){

            $subcategory= new Subcategory;
            $subcategory->name=$request->name;
            $subcategory->slug=$request->slug;
            $subcategory->category_id=$request->category_id;
            $subcategory->status=$request->status;
            $subcategory->showHome=$request->showHome;
            $subcategory->save();

            session()->flash('success','subcategory added successfully');

            return response()->json([
                'status'=>true,
                'message' =>'subcategory added successfully'
            ]);
    
            // return redirect()->route('subcategory.index')->with('success','subCategory added successfully');

        }
        else{

            return response()->json([
                'status'=>false,
                'errors' =>$validator->errors()
            ]);
            // return redirect()->route('subcategory.create')->withInput()->withErrors( $validator);
        }
       
             
 
    }
     public function edit($id, Request $request){
        $subcategory= Subcategory::findOrFail($id);
        if(empty($subcategory)){
            return redirect()->route('subcategory.index');
        }
        
       $categories= Category::orderBy('category_name','ASC')->get();
       return view('admin.subcategory.edit',compact('categories','subcategory'));
     }
     public function update($id,Request $request){

        $subcategory=Subcategory::findOrFail($id);
       

        $validator= Validator::make($request->all(),[
            'name' =>'required',
            'slug' =>'required|unique:subcategories',
          
        ]);


        if ($validator->passes()){

            $subcategory->name=$request->name;
            $subcategory->slug=$request->slug;
            $subcategory->category_id=$request->category_id;
            $subcategory->status=$request->status;
            $subcategory->showHome=$request->showHome;
            $subcategory->update();

            session()->flash('success','subcategory updated successfully');
          
            return response()->json([
                'status'=>true,
                'message' =>'subcategory updated successfully'
            ]);

        }
        else{
            return response()->json([
                'status'=>false,
                'errors' =>$validator->errors()
            ]);
        }
     }
     public function destroy($id){
        $subcategory= Subcategory::findOrFail($id);
        $subcategory->delete();

        session()->flash('success','subcategory deleted successfully');
        return response()->json([
            'status'=>true,
            'message' =>"subcategory deleted successfully"
        ]);
        return redirect()->route('subcategory.index');
     }
         
   
}
