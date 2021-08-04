<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Support\Str;
class OrderController extends Controller
{
    public function placeOrder(Request $request){
        $cart = Cart::with(['product','user'])->get();
        $order = new Order;
        $user_id = auth('api')->id();
        $order['user_id'] = $user_id;
        $order['cart'] = utf8_encode(bzcompress(serialize($cart), 9)); 
        $order['totalQty'] = $request->totalQty;
        $order['pay_amount'] = round($request->total) + $request->shipping_cost + $request->packing_cost;
        $order['method'] = $request->method;
        $order['shipping'] = $request->shipping;
        $order['pickup_location'] = $request->pickup_location;
        $order['customer_email'] = $request->email;
        $order['customer_name'] = $request->name;
        $order['shipping_cost'] = $request->shipping_cost;
        $order['packing_cost'] = $request->packing_cost;
        $order['tax'] = $request->tax;
        $order['customer_phone'] = $request->phone;
        $order['order_number'] = Str::random(40).time();
        $order['customer_address'] = $request->address;
        $order['customer_country'] = $request->customer_country;
        $order['customer_city'] = $request->city;
        $order['customer_zip'] = $request->zip;
        $order['order_note'] = $request->order_notes;
        $order['coupon_code'] = $request->coupon_code;
        $order['coupon_discount'] = $request->coupon_discount;
        $order['dp'] = $request->dp;
        $order['payment_status'] = "Pending";
        $order['currency_sign']=$request->currency_sign;
        $order['currency_value']=1;
        $order->save();
        Cart::where('user_id', $user_id)->delete();
        return json_encode(['code'=>200,'responce'=>'Prroduct added to the store successfully']);
        

    }
    public function orderslist(){
        $user_id = auth('api')->id();
        $order = Order::where('user_id',$user_id)->get();
        return json_encode(['code'=>200,'orderslist'=>$order]);
    }

    public function orderdetails($id){
        $order = Order::find($id);
        $cart = unserialize(bzdecompress(utf8_decode($order->cart)));
        return json_encode(['code'=>200,'orderdetails'=>$order,'cart'=>$cart]);
    }
}
