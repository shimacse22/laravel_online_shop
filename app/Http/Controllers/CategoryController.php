<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;
use App\Models\TempImage;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

//use Intervention\Image\Facades\Image;
use Image;


class CategoryController extends Controller
{
    //

    public function index(Request $request){
        $categories=Category::latest();

        if(!empty($request->keyword)){
            $categories= $categories->where('category_name','like','%'.$request->get('keyword').'%');
        }
        $categories= $categories->paginate(10);
        return view('admin.category.showcategory',compact('categories'));

    }

    public function create(){
        return view('admin.category.create');
    }

    
    public function store(Request $request){

      
       
        $validator= Validator::make($request->all(),[
            'category_name' =>'required',
            'category_slug' =>'required|unique:categories',
           // 'category_img'=>'required|image',
            'showHome'=>'required'
        ]);


        if ($validator->passes()){
           
            $category=new Category();
            $category->category_name=$request->category_name;
            $category->category_slug=$request->category_slug;
            $category->status=$request->status;
            $category->showHome=$request->showHome;
            $category->save();

            //Image save here
            if(!empty($request->image_id)){

                $TempImage=TempImage::find($request->image_id);
                $extArray=explode('.',$TempImage->name);
                $ext=last($extArray);
               

                $newImageName=$category->id.'-'.time().'.'. $ext;

                $sPath=public_path().'/upload/Temp-image/'.$TempImage->name;
                $dPath=public_path().'/upload/category-images/'.$newImageName;

                File::copy( $sPath, $dPath);

                //Generate image thumbnail
                $dPath=public_path().'/upload/category-images/thumb/'.$newImageName;
                $manager = new ImageManager(Driver::class);
                $image = $manager->read( $sPath);
                $image->cover(150, 150);
                $image->save($dPath);

                 $category->category_img= $newImageName;
                 $category->save();

            }


            session()->flash('success','category added successfully');
            return response()->json([
                'status'=>true,
                'message' =>'category added successfully'
            ]);
           

        }
        else{
           
            return response()->json([
                'status'=>false,
                'errors' =>$validator->errors()
            ]);
           
        }
            
    }
    public function edit($category_id){
        $category= Category::findOrFail($category_id);

        return view('admin.category.edit',compact('category'));
        
    }
    public function update($category_id,Request $request){
        $category= Category::findOrFail($category_id);

        $validator= Validator::make($request->all(),[
            'category_name' =>'required',
            'category_slug' =>'required|unique:categories,category_slug,'.$category->id.',id',
           // 'category_img'=>'required|image',
            'showHome'=>'required'
        ]);


        if ($validator->passes()){
           
            $category->category_name=$request->category_name;
            $category->category_slug=$request->category_slug;
            $category->status=$request->status;
            $category->showHome=$request->showHome;
           // $category->category_img= $imageName;
            $category->update();
            $oldImage=$category->category_img;

            //Image save here
            if(!empty($request->image_id)){

                $TempImage=TempImage::find($request->image_id);
                $extArray=explode('.',$TempImage->name);
                $ext=last($extArray);
              

                $newImageName=$category->id.'-'.time().'.'. $ext;

                $sPath=public_path().'/upload/Temp-image/'.$TempImage->name;
                $dPath=public_path().'/upload/category-images/'.$newImageName;

                File::copy( $sPath, $dPath);

                //Generate image thumbnail
                $dPath=public_path().'/upload/category-images/thumb/'.$newImageName;
                $manager = new ImageManager(Driver::class);
                $image = $manager->read( $sPath);
                $image->cover(150, 150);
                $image->save($dPath);
                File::delete(public_path().'/upload/category-images/thumb/'.$oldImage);
                File::delete(public_path().'/upload/category-images/'.$oldImage);


                 $category->category_img= $newImageName;
                 $category->update();
                
            }
            session()->flash('success','category updated successfully');
            return response()->json([
                'status'=>true,
                'message' =>'category updated successfully'
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
        
        $category= Category::findOrFail($id);

        if(empty($category)){
            return redirect()->route('category.show');
        }

        //delete image from folder
      
        File::delete(public_path().'/upload/category-images/thumb/'. $category->category_img);
        File::delete(public_path().'/upload/category-images/'.$category->category_img);

        // delete image from database

        $category->delete();

        session()->flash('success','category deleted successfully');
        return response()->json([
            'status'=>true,
            'message'=>'Category deleted successfully'
        ]);

    }
        
  
}
