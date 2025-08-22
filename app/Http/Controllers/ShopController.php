<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductRatings;
use Illuminate\Support\Facades\Validator;

class ShopController extends Controller
{
   
  

    public function index(Request $request,$categorySlug=null,$subCategorySlug=null){
       //for selected category and subcategory

      $categorySelected='';
      $subCategorySelected='';
      $brandArray[]='';
     

        $categories=Category::orderBy('category_name','ASC')
        ->with('subCategory')
        ->where('status',1)
        ->get();

        $brands=Brand::orderBy('name','ASC')->where('status',1)->get();
        $products=Product::where('status',1);
       // $products= $products->orderBy('id','DESC');

        //Apply filters here

          // if(!empty($categorySlug)){
          //   $category= Category::where('category_slug',$categorySlug);
          //   $categorySelected= $category->id;
          //   $products=$products->where('category_id',$category->id);
           

          // }

          if (!empty($categorySlug)) {
            $category = Category::where('category_slug', $categorySlug)->first(); // Use first() to retrieve the model instance
            if ($category) { // Check if the category exists
                $categorySelected = $category->id;
                $products = $products->where('category_id', $category->id);
            }
        }

          // if(!empty($subCategorySlug)){
          //     $Subcategory= Subcategory::where('slug',$subCategorySlug);
          //     $subCategorySelected=$Subcategory->id;
          //     $products=$products->where('subcategory_id', $Subcategory->id);
             
        
          //   }

          if (!empty($subCategorySlug)) {
            $subcategory = Subcategory::where('slug', $subCategorySlug)->first(); // Use first() to retrieve the model instance
            if ($subcategory) { // Check if the subcategory exists
                $subCategorySelected = $subcategory->id;
                $products = $products->where('subcategory_id', $subcategory->id);
            }
        }

            if(!empty($request->get('brand'))){
                $brandArray=explode(',',$request->get('brand'));
                $products= $products->whereIn('brand_id',$brandArray);
              }
         
          if($request->get('price_max')!='' && $request->get('price_min')!= ''){
                if($request->get('price_max')==1000){
                  $products= $products->whereBetween('price', [intval($request->get('price_max')),10000000]);
                }
             
                else{
                  $products= $products->whereBetween('price', [intval($request->get('price_min')),intval($request->get('price_max'))]);
                }
              }

        if(!empty($request->get('sort'))){
            if($request->get('sort')=='latest'){
              $products=$products->orderBy('id','DESC');
            }
            else if($request->get('sort')=='price_desc'){
              $products=$products->orderBy('price','DESC');
            }
            else{
              $products=$products->orderBy('price','ASC');
            }
        }
        else{
            $products=$products->orderBy('id','DESC');
         } 

       //  $products=$products->get();
        
         //for search product

          if(!empty($request->get('search'))){

            $products=$products->where('title','like','%'.$request->get('search').'%');

          }

    
        $products=$products->paginate(10);

        $data['categories']=$categories;
        $data['products']=$products;
        $data['categorySelected']=$categorySelected;
        $data['subCategorySelected']=$subCategorySelected;
        $data['brands']=$brands;
        $data['brandArray']=$brandArray;
        $data['priceMax']=(intval($request->get('price_max'))==0) ? 1000 : $request->get('price_max');
        $data['priceMin']=intval($request->get('price_min'));
        $data['sort']=$request->get('sort');

        return view('frontend.shop',$data);
    }

    public function product($slug){
      $product=Product::where('slug',$slug)
      ->withCount('product_ratings')
      ->withSum('product_ratings','ratings')
      ->with('product_images','product_ratings')->first();
      //dd( $product);
      //$ratings=ProductRatings::where('product_id',$product->id)->get();
      if($product==null){
        abort(404);
      }

      //calculate ratings

        $avgRatingPer=0;
        $avgRating='0.00';
   //   $ratingPer=number_format('product_ratings_sum_ratings*100')/5
   if($product->product_ratings_count >0){
    $avgRating=number_format(($product->product_ratings_sum_ratings/$product->product_ratings_count),2);
    $avgRatingPer=($avgRating*100)/5;
   }

  
      

        //fetch related products
        $relatedProducts=[];
        if($product->related_products != " "){
            $productArray= explode(',',$product->related_products);
            $relatedProducts=Product::whereIn('id',$productArray)->where('status',1)->get();

        }

      return view('frontend.product',compact('product','relatedProducts','avgRating','avgRatingPer'));
    }

    public function productRatings($product_id,Request $request){

      $validator=Validator::make($request->all(),[
        'username' => 'required',
        'email' => 'required|email',
        'comment' => 'required|min:10',
        'rating' => 'required|integer|between:1,5', // Assuming rating is between 1 and 5

      ]);

      if($validator->fails()){
     
        return response()->json([
          'status'=>false,
          'errors'=>$validator->errors(),
        ]);
      }
      // Check if the user has already rated this product
    $existingRating = ProductRatings::where('product_id', $product_id)
    ->where('email', $request->email)
    ->first();
    if ($existingRating) {
      // If a rating exists, return a JSON response indicating the user has already rated

      session()->flash('error','You have already rated this product.');
      return response()->json([
          'status' => true,
          'message' => 'You have already rated this product.',
      ]);
  }
    // Create a new rating entry
      $ratings=new productRatings();
      $ratings->product_id=$product_id;
      $ratings->username=$request->username;
      $ratings->email=$request->email;
      $ratings->comment=$request->comment;
      $ratings->ratings=$request->rating;
      $ratings->status=0;
      $ratings->save();
     
     session()->flash('success','Thanks for your ratings.');
    
      return response()->json([
        'status'=>true,
        'message'=>'Thanks for your ratings.',
      ]);

   

    }

  
}
