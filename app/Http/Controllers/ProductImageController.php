<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductImages;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;


class ProductImageController extends Controller
{
    //

    public function update(Request $request){
        $image=$request->image;
        $ext= $image->getClientOriginalExtension();
        $sPath=$image->getPathName();

        $productImages= new ProductImages();
        $productImages->product_id= $request->product_id;
        $productImages->image="NULL";
        $productImages->save();

        $imageName= $request->product_id. '-' . $productImages->id. '-' .time(). '.' . $ext ;
        $productImages->image= $imageName;
        $productImages->save();

         //Generate thumbnail image

                    //Large Image
                   
                    $dPath=public_path().'/upload/product-images/large/'.$imageName;
        
                    $manager = new ImageManager(Driver::class);
                    $image = $manager->read( $sPath);
                   

                    $image->resize(1400, null, function ($constraint) {
                        $constraint->aspectRatio();
                    });

                    $image->save($dPath);

                    //Small Image

                    $dPath=public_path().'/upload/product-images/small/'.$imageName;
        
                    $manager = new ImageManager(Driver::class);
                    $image = $manager->read( $sPath);
                   
                    $image->cover(300,300);

                    $image->save($dPath);

                    return response()->json([
                        'status' =>'true',
                        'image_id'=>$productImages->id,
                        'ImagePath'=>asset('upload/product-images/small/'.$productImages->name),
                        'message'=>'Image Updated Successfully'
                    ]);

    }

    public function destroy(Request $request){
        $productImages= ProductImages::find($request->id);

        if(empty($productImages)){
            return response()->json([
                'status' =>'false',
                'message'=>'Image not found'
            ]);

        }

        //Delete images from folder
        File::delete(public_path('upload/product-images/small/'. $productImages->image));
        File::delete(public_path('upload/product-images/large/'. $productImages->image));

        //Delete images from folder

        $productImages->delete();

        return response()->json([
            'status' =>'true',
            'image_id'=>$productImages->id,
            'ImagePath'=>asset('upload/product-images/small/'.$productImages->name),
            'message'=>'Image deleted Successfully'
        ]);

    }
}
