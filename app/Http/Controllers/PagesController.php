<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;

use Illuminate\Support\Facades\Validator;

class PagesController extends Controller
{
    //
    public function index(Request $request){
        $pages=Page::latest();
       if(!empty($request->keyword)){
        $pages=$pages->where('name','like','%'.$request->get('keyword').'%');
        }
       
        $pages=$pages->paginate(2);
        return view('admin.page.index',compact('pages'));
    }

    public function create(){
        return view('admin.page.create');
    }
    public function store(Request $request){

      
       
        $validator= Validator::make($request->all(),[
            'name' =>'required',
            'slug' =>'required|unique:pages',
            
        ]);


        if ($validator->passes()){
           
            $page=new Page();

            $page->name=$request->name;
            $page->slug=$request->slug;
            $page->content=$request->content;
            $page->save();

            session()->flash('success','page added successfully');
            return response()->json([
                'status'=>true,
                'message' =>'page added successfully'
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
        $page= Page::findOrFail($id);

        return view('admin.page.edit',compact('page'));
        
    }
    public function update($id,Request $request){

        $page= page::findOrFail($id);

        $validator= Validator::make($request->all(),[
            'name' =>'required',
            'slug' =>'required|unique:pages',
           
        ]);


        if ($validator->passes()){

          
            $page->name=$request->name;
            $page->slug=$request->slug;
            $page->content=$request->content;
            $page->update();

           session()->flash('success','page updated successfully');
            return response()->json([
                'status'=>true,
                'message' =>'page updated successfully'
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
        
        $page= Page::findOrFail($id);

        if( $page==null){
            session()->flash('error','Page not found');
            return response()->json([
                'status'=>true,
                
            ]);

        }

        $page->delete();

        session()->flash('success','Page deleted successfully');
        return response()->json([
            'status'=>true,
            'message'=>'Page deleted successfully'
            
        ]);

    
}
}
