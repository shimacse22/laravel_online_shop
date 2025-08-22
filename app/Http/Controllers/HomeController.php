<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Wishlist;
use App\Models\Page;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    //

    public function index(){

        $isFeatured_products=Product::orderBy('title','DESC')
        ->where('is_featured','Yes')
        ->where('status',1)
        ->take(4)
        ->get();

        $latest_products=Product::orderBy('title','DESC')
        ->where('status',1)
        ->take(4)
        ->get();
        return view('frontend.home',compact('isFeatured_products','latest_products'));
    }
    public function addToWishList(Request $request){

        // Check if the user is authenticated
    if (!Auth::check()) {
        // Store the intended URL and return a JSON response indicating the user is not authenticated
        session(['url.intended' => url()->previous()]);
        return response()->json([
            'status' => false,
            'message' => 'Please log in to add items to your wishlist.'
        ]);
    }

    // Retrieve the product by ID
    $product = Product::find($request->id);

    // If the product is not found, return a JSON response with an error message
    if (!$product) {
        return response()->json([
            'status' => false,
            'message' => 'Product not found.'
        ]);
    }

    // Check if the product is already in the user's wishlist
    $wishlistItem = Wishlist::where('user_id', Auth::id())
        ->where('product_id', $request->id)
        ->first();

    if ($wishlistItem) {
        // If the product is already in the wishlist, return a JSON response indicating so
        return response()->json([
            'status' => true,
            'message' => '<div class="alert alert-info"><strong>"' . $product->title . '"</strong> is already in your wishlist.</div>'
        ]);
    } else {
        // If the product is not in the wishlist, add it
        Wishlist::create([
            'user_id' => Auth::id(),
            'product_id' => $request->id,
        ]);

        // Return a JSON response indicating the product was added successfully
        return response()->json([
            'status' => true,
            'message' => '<div class="alert alert-success"><strong>"' . $product->title . '"</strong> has been added to your wishlist successfully.</div>'
        ]);
    }

    }

    public function page($slug){

        $page=Page::where('slug',$slug)->first();

        if($page==null){
            abort(404);
        }

        return view('frontend.page',compact('page'));


    }
}
