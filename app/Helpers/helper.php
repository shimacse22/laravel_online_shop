<?php

use App\Mail\OrderEmail;
use App\Models\Category;
use App\Models\Country;
use App\Models\Order;
use App\Models\ProductImages;
use App\Models\Page;
use Illuminate\Support\Facades\Mail;



function getCategories(){
    return Category::orderBy('category_name','ASC')
    ->with('subCategory')
    ->where('status',1)
    ->where('showHome','YES')
    ->get();
} 
function getProductImages($productId){
return ProductImages::where('product_id',$productId)->first();
}

function staticPages(){
    $page= Page::orderBy('name','ASC')->get();

    return $page;
}

function orderEmail($orderId,$userType="customer"){
    $order=Order::where('id',$orderId)->with('items')->first();
   //dd($order);
   if($userType=="customer"){
    $subject="Thanks for your order";
    $email= $order->email;
   }
   else{
    $subject="You have receive an order";
    $email= "shima@gmail.com";
   }


    $mailData=[
        'subject'=>$subject,
        'order'=>$order,
        'userType'=>$userType,
    ];

    Mail::to($email)->send(new OrderEmail($mailData));

}

function getOrderCountry($id){
    return Country::where('id',$id)->first();
}

?>
