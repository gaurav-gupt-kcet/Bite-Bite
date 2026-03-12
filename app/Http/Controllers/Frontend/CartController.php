<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function add($id)
    {
        $product = Product::findOrFail($id);

        $cart = session()->get('cart', []);

        if(isset($cart[$id])){

            $cart[$id]['quantity']++;

        } else {

            $cart[$id] = [
                "name" => $product->name,
                "price" => $product->price,
                "image" => $product->image,
                "quantity" => 1
            ];

        }

        session()->put('cart', $cart);

        return back()->with('success', $product->name . ' added to cart!');
    }


    public function cart()
    {
        return view('frontend.cart');
    }


    public function remove($id)
    {
        $cart = session()->get('cart');

        if(isset($cart[$id])){
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect('/cart');
    }


    public function update(Request $request)
    {
        $cart = session()->get('cart');

        foreach($request->quantity as $id => $qty){

            if(isset($cart[$id])){
                $cart[$id]['quantity'] = $qty;
            }

        }

        session()->put('cart', $cart);

        return redirect('/cart');
    }
}