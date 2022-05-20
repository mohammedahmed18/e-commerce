<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class OrdersController extends Controller
{
    public function arriveOrder($id){
        $order = Order::find($id);
        $order->status = 3;
        $order->save();
        return redirect('/dashboard/order/details/'.$id);
    }
    public function approveOrder($id){
        $order = Order::find($id);
        // reduce stock
        foreach ($order->order_items as $item) {
            $prod_id = $item->product_id;
            $product = Product::find($prod_id);
            if($product->stock - $item->quantity < 0){
                Session::flash('toast-error' , $product->name.' stock doesn\'t have enough items to complete the order');
                return Redirect::back();
            }
            
            $order->status = 2;
            $order->save();

            $product->stock -= $item->quantity;
            $product->save();
        }
        return redirect('/dashboard/order/details/'.$id);
    }
    public function makeOrder(Request $req)
    {
        $req->validate([
            'address' => 'required'
        ]);
        $address = $req->input('address');
        // make a new order
        $order = new Order();
        $order->user_id = Auth::id();
        $order->address = $address;
        $order->total = $req->input('total');
        $order->save();

        $cartItems = Auth::user()->cart_items;
        foreach ($cartItems as $item) {
            // create order Items
            $orderItem = new OrderItem();
            $orderItem->order_id = $order->id;
            $orderItem->product_id = $item->product_id;
            $orderItem->quantity = $item->quantity;
            $orderItem->save();
            // delete cart item
            CartItem::find($item->id)->delete();
        }

    Session::flash('toast-success' , 'your order is submitted successfully');
    return redirect('/cart');
    
    }
    public function getAllOrders(Request $req){
        //1 -> pending
        //2 -> out for delivery
        //3 -> recieved
        // 4 -> cancel
        $status = $req->status;
        if(! $status){
            return redirect("/dashboard/orders?status=1");
        }

        $orders = null;
        if($status == "1"){
        // pending
             $orders = Order::where('status' , 1)->orderBy('id','desc')->get();
        }
        elseif($status == 2){
            $orders = Order::where('status' , 2)->orderBy('id','desc')->get();
        }
        elseif($status == 3){
            $orders = Order::where('status' , 3)->orderBy('id','desc')->get();
            
        }else{
            abort(404);
        }

        return view('pages.dashboard.orders' , ['orders' => $orders]);

    }
    public function orderDetails($id){
        $order = Order::find($id);
        if(! $order) return abort(404);
        $user = $order->user;
        $items = $order->order_items;
        return view('pages.dashboard.orderdetails' , ['order' => $order , 'user' => $user , 'items' => $items]);
    }
}
