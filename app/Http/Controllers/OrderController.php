<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    //
    public function index(Request $request){
        
        $orders=Order::latest('orders.created_at')->select('orders.*','users.name','users.email','users.phone');
        $orders= $orders->leftJoin('users','users.id','orders.user_id');
        if($request->get('keyword') !="" ){
        $orders=$orders->where('users.name','like','%'.$request->get('keyword').'%')
                        ->orWhere('users.email','like','%'.$request->get('keyword').'%')
                        ->orWhere('orders.id','like','%'.$request->get('keyword').'%');
        }
        $orders=$orders->paginate(5);
        $data['orders']=$orders;
        return view('admin.order.order-details',$data);
    }

public function detail($orderId){

     $order=Order::select('orders.*','countries.name as countryName')
     ->where('orders.id',$orderId)
     ->leftJoin('countries','countries.id','orders.country_id')
     ->first();

    $orderItems=OrderItem::where('order_id',$orderId)->get();

    $data['orderItems']=$orderItems;
    $data['order']=$order;
    return view('admin.order.order',$data);
}

public function changeOrderStatus(Request $request, $orderId){
    $order=Order::find($orderId);
    $order->status=$request->status;
    $order->shipped_date=$request->shipped_date;
    $order->save();
    session()->flash('success','Order Status Updated Successfully');
    return response()->json([
        'status'=>'true',
        'message'=>'Order Status Updated Successfully'

    ]);
}

public function sendInvoiceEmail(Request $request,$orderId){

    orderEmail($orderId,$request->userType);
    session()->flash('success','order email send successfully');
    return response()->json([
        'status'=>'true',
        'message'=>'order email send successfully'

    ]);
}

}
