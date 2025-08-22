<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Brand;
use App\Models\ProductImages;
use App\Models\TempImage;
use App\Models\ProductRatings;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;


class ProductController extends Controller
{
    //
    public function index(Request $request){
        
        $products= Product::latest('id')->with('product_images');
       
       // dd($products);
        if(!empty($request->keyword)){
            $products= $products->where('title','like','%'.$request->get('keyword').'%');
        }
        $products=  $products->paginate(10);
        return view('admin.product.index',compact('products'));
    }
    public function create(){
        $categories=Category::orderBy('category_name','ASC')->get();
       // $subcategories=Subcategory::orderBy('name','ASC')->get();
        $brands=Brand::orderBy('name','ASC')->get();
        return view('admin.product.create',compact('categories','brands'));
    }

    public function store(Request $request){
     //   dd($request);
        $rules=[
            'title' =>'required',
            'slug' =>'required|unique:products',
            'price'=>'required|numeric',
            'sku'=>'required',
            'barcode'=>'required',
            'track_qty'=>'required|in:Yes,No',
           // 'qty'=>'required',
            'category'=>'required',
            'sub_category' => 'required|exists:subcategories,id',
            'status'=>'required',
            'is_featured'=>'required|in:Yes,No'

        ];

        if(!empty($request->track_qty) && $request->track_qty =='Yes'){
            $rules['qty']='required|numeric';
        }
     
         $validator= Validator::make($request->all(),$rules);
 
       
 
         if ($validator->passes()){
            $product=new Product();
            $product->title=$request->title;
            $product->slug=$request->slug;
            $product->description=$request->description;
            $product->price=$request->price;
            $product->compare_price=$request->compare_price;
            $product->category_id=$request->category;
            $product->subcategory_id=$request->sub_category;
            $product->brand_id=$request->brand;
            $product->sku=$request->sku;
            $product->barcode=$request->barcode;
            $product->track_qty=$request->track_qty;
            $product->qty=$request->qty;
            $product->status=$request->status;
            $product->short_description=$request->short_description;
            $product->shipping_returns=$request->shipping_returns;
            $product->related_products=(!empty($request->related_products))?implode(',',$request->related_products):"";

            $product->save();
            
            //save gallery images

            if(!empty($request->image_array)){
                foreach($request->image_array as $temp_img_id){
                    $tempImageInfo=TempImage::find($temp_img_id);

                    $extArray=explode('.', $tempImageInfo->name);
                    $ext=last($extArray);

                    $productImages= new ProductImages();
                    $productImages->product_id= $product->id;
                    $productImages->image="NULL";
                    $productImages->save();

                    $imageName= $product->id. '-' . $productImages->id. '-' .time(). '.' . $ext ;
                    $productImages->image= $imageName;
                    $productImages->save();

                    //Generate thumbnail image

                    //Large Image
                    $sPath=public_path().'/upload/Temp-image/'. $tempImageInfo->name;
                    $dPath=public_path().'/upload/product-images/large/'.$productImages->image;
        
                    $manager = new ImageManager(Driver::class);
                    $image = $manager->read( $sPath);

                    $image->resize(1400, null, function ($constraint) {
                        $constraint->aspectRatio();
                    });

                    $image->save($dPath);

                    //Small Image

                    $dPath=public_path().'/upload/product-images/small/'.$productImages->image;
        
                    $manager = new ImageManager(Driver::class);
                    $image = $manager->read( $sPath);

                    $image->cover(300,300);

                    $image->save($dPath);


                }
            }
            
 
          session()->flash('success','Product added successfully');
          
             return response()->json([
                 'status'=>true,
                 'message' =>'Product added successfully'
             ]);
 
         }
         else{
             return response()->json([
                 'status'=>false,
                 'errors' =>$validator->errors()
             ]);

         }
             
     }
     public function edit($id,Request $request){
        $product=Product::findOrFail($id);

        if(empty($product)){
            return redirect()->route('product.index')->with('success','Product not found');
        }
        $productImages=ProductImages::where('product_id',$product->id)->get();

        $subCategories=Subcategory::where('category_id',$product->category_id)->get();
        $categories=Category::orderBy('category_name','ASC')->get();
        //$subcategories=Subcategory::orderBy('name','ASC')->get();
        $brands=Brand::orderBy('name','ASC')->get();

        //fetch related products
        $relatedProducts=[];
        if($product->related_products != " "){
            $productArray= explode(',',$product->related_products);
            $relatedProducts=Product::whereIn('id',$productArray)->get();

        }
        return view('admin.product.edit',compact('product','categories','subCategories','brands','productImages','relatedProducts'));
         
     }
     public function update($id,Request $request){
       // dd($request->all());
        $product=Product::findOrFail($id);
        $rules=[
            'title' =>'required',
            'slug' =>'required|unique:products,slug,'.$product->id.',id',
            'price'=>'required|numeric',
            'sku'=>'required|unique:products,sku,'.$product->id.',id',
            'barcode'=>'required',
            'track_qty'=>'required|in:Yes,No',
           // 'qty'=>'required',
            'category'=>'required',
            'sub_category' => 'required|exists:subcategories,id',
            //'status'=>'required',
            'is_featured'=>'required|in:Yes,No'

        ];

        if(!empty($request->track_qty) && $request->track_qty =='Yes'){
            $rules['qty']='required|numeric';
        }
    
         $validator= Validator::make($request->all(),$rules);
 
       
 
         if ($validator->passes()){
            
            $product->title=$request->title;
            $product->slug=$request->slug;
            $product->description=$request->description;
            $product->price=$request->price;
            $product->compare_price=$request->compare_price;
            $product->category_id=$request->category;
            $product->subcategory_id=$request->sub_category;
            $product->brand_id=$request->brand;
            $product->sku=$request->sku;
            $product->barcode=$request->barcode;
            $product->track_qty=$request->track_qty;
            $product->is_featured=$request->is_featured;
            $product->qty=$request->qty;
            $product->status=$request->status;
            $product->short_description=$request->short_description;
            $product->shipping_returns=$request->shipping_returns;
            $product->related_products=(!empty($request->related_products))?implode(',',$request->related_products):"";
            $product->update();

            //save gallery images

           
            
            
 
           session()->flash('success','product updated successfully');
          
             return response()->json([
                 'status'=>true,
                 'message' =>'Product updated successfully'
             ]);
    
          
            }
         else{
             return response()->json([
                 'status'=>false,
                 'errors' =>$validator->errors()
             ]);
         }
         
     }
     public function destroy($id,Request $request){
        $product=Product::findOrFail($id);
        if(empty( $product)){
           session()->flash('error','Product not found');
            return response()->json([
                'status'=>false,
                'notFound' =>true
            ]);
        }
        $productImages= ProductImages::where('product_id',$id)->get();

        if(!empty($productImages)){
            foreach($productImages as $productImage){
                //Delete images from folder
        File::delete(public_path('upload/product-images/small/'. $productImage->image));
        File::delete(public_path('upload/product-images/large/'. $productImage->image)); 
            }
            $productImages= ProductImages::where('product_id',$id)->delete();
        }
       
        $product->delete();

        session()->flash('success','Product Deleted Successfully');
        return response()->json([
            'status'=>true,
            'message' =>'Product Deleted Successfully'
        ]);

        return redirect()->route('product.index');
}
public function getProducts(Request $request){
    $tempProduct=[];

    if($request->term != ""){
        $products=Product::where('title','like','%'.$request->term.'%')->get();

        if($products != null){
            foreach($products as $product){
                $tempProduct[]=array('id'=>$product->id,'text'=>$product->title);
            }
        }
    }
    //print_r($tempProduct);
    return response()->json([
        'tags'=>$tempProduct,
        'status'=>true

    ]);

}

public function productRatings(Request $request){
   
    $ratings=ProductRatings::select('product_ratings.*','products.title as productTitle')->orderBy('product_ratings.created_at','DESC');
   

    $ratings=$ratings->leftJoin('products','products.id','product_ratings.product_id')->get();
    
    // $ratings=$ratings->paginate(2);
    // if(!empty($request->keyword)){
    //     $ratings=$ratings->orWhere('products.title','like','%'.$request->get('keyword').'%');
    //     $ratings=$ratings->orWhere('product_ratings.username','like','%'.$request->get('keyword').'%');

       
    // }

    return view('admin.product.rating',[
        'ratings'=> $ratings,
       
    ]);

}

public function changeRatingStatus(Request $request){

    $productRatings=ProductRatings::find($request->id);
    $productRatings->status=$request->status;
    $productRatings->save();

    session()->flash('success','Ratings Status Changed Successfully');
    return response()->json([
        'status'=>true,
        'message' =>'Ratings Status Changed Successfully'
    ]);

}

}