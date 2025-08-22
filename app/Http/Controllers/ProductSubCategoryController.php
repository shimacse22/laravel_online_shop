<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subcategory;

class ProductSubCategoryController extends Controller
{
    //
    public function index(Request $request){
        if(!empty($request->category_id)){
            $subcategories= Subcategory::where('category_id',$request->category_id)
            ->orderBy('name','ASC')
            ->get();

            return response()->json([
                'status'=>true,
                'subcategories'=> $subcategories
            ]);
        }
       else{
            return response()->json([
                'status'=>false,
                'subcategories'=>[]
            ]);
       }

    }
}
