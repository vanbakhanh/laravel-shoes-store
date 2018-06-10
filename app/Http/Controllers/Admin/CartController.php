<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;
use Auth;
use Cart;

class CartController extends Controller
{
    public function index()
    {
    	$items = Cart::content();
    	return view('frontend.cart.index', compact('items'));
    }

    public function addItem(Request $request)
    {
    	$product = Product::findOrFail($request->productId);
    	Cart::add([
    		'id' => $product->id,
    		'name' => $product->name,
    		'price' => $product->price,
    		'qty' => $request->qty,
    		'options' => [
                'size' => $request->size, 
                'color' => $request->color,
            ],
        ]);
    	return redirect()->back();
    }

    public function update(Request $request)
    {
        Cart::update($request->rowId, $request->qty);
        return redirect()->back();
    }

    public function removeItem($rowId)
    {
    	Cart::remove($rowId);
    	return redirect()->back();
    }

    public function checkout()
    {
        $user = Auth::user();
        $order = $user->orders()->create([
            'total' => Cart::total(),
        ]);
        foreach (Cart::content() as $data) {
            $order->products()->attach($data->id, [
                'qty' => $data->qty,
                'total' => $data->price * $data->qty,
                'size' => $data->options->size,
                'color' => $data->options->color,
            ]);
        }
        Cart::destroy();
        return redirect()->back()->with('status', 'Thank you for shopping at Nike! Your order has been received and is going through verification process.');
    }
}
