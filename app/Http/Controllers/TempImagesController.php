<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TempImage;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class TempImagesController extends Controller
{
    //
    public function create(Request $request){
        $image=$request->image;

        if(!empty($image)){
            $ext= $image->getClientOriginalExtension();

            $newName= time().'.'.$ext;
            $tempImage= new TempImage();
            $tempImage->name=$newName;
            $tempImage->save();

            $image->move(public_path('upload/Temp-image'), $newName);

            //Generate Thumbnail

            $sPath=public_path().'/upload/Temp-image/'. $newName;
            $dPath=public_path().'/upload/product-images/'.$newName;

            File::copy( $sPath, $dPath);
            $dPath=public_path().'/upload/product-images/thumb/'.$newName;

            $manager = new ImageManager(Driver::class);
            $image = $manager->read( $sPath);
            $image->cover(300, 275);
            $image->save($dPath);



            return response()->json([
                'status'=>true,
                'image_id'=> $tempImage->id,
                'ImagePath'=>asset('/upload/product-images/thumb/'.$newName),
                'message'=>'Image Uploaded Successfully'
            ]);
        }


    }
}
