<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{

    public function removeCartItem(Request $req){
        $id = $req->input('cartItemId');
        $cartItem = CartItem::find($id);
        $cartItem->delete();
        return redirect('/cart');
    }


    // api end point
    public function changeQuantiy(Request $req){
        $type = $req->type;
        $id = $req->id;
        $cartItem = CartItem::find($id);
        if($type == 1){
            // increase
            $cartItem->quantity = $cartItem->quantity + 1;
            $cartItem->save();              
        }elseif($type == 0){
            if($cartItem->quantity > 0){
                $cartItem->quantity = $cartItem->quantity - 1;
                if($cartItem->quantity == 0){
                    return $cartItem->delete();
                }
                $cartItem->save();              
            }
        }
        return;
    }

public function showCartPage(){
    $cartItems = Auth::user()->cart_items;
    $totalPrice = 0;
    
    $products = [];

    foreach ($cartItems as $item) {
        $product = Product::find($item->product_id);
        array_push($products , $product);
        $totalPrice += $item->quantity * $product->price;
    }
    return view('pages.landpage.cart',['cartItems' => $cartItems ,'products' => $products,'totalPrice' => $totalPrice]);    
}

 public function addToCart(Request $req){
    $req->validate(['quantity' => 'required|min:1']);
    $product_id = $req->input('product_id');
    $quantity = $req->input('quantity');

    $cartItem = new CartItem();
    $cartItem->user_id = Auth::id();
    $cartItem->product_id = $product_id;
    $cartItem->quantity = $quantity;

    $cartItem->save();
    Session::flash('toast-success' , 'item added to the cart');
    return redirect('/cart');
}


}
