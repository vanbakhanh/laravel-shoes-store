<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\OrderShipped;
use App\Models\Product;
use App\Models\Order;
use Auth;
use Cart;
use Mail;


class CartController extends Controller
{
    /**
     * Display cart.
     */
    public function index()
    {
    	$items = Cart::content();

    	return view('frontend.cart.index', compact('items'));
    }

    /**
     * Add to cart.
     */
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
                'image' => $product->image,
            ],
        ]);

    	return back();
    }

    /**
     * Update cart.
     */
    public function update(Request $request)
    {
        Cart::update($request->rowId, $request->qty);

        return back();
    }

    /**
     * Remove item in cart.
     */
    public function removeItem($rowId)
    {
    	Cart::remove($rowId);

    	return back();
    }

    /**
     * Checkout and send mail to user.
     */
    public function checkout()
    {
        $user = Auth::user();
        
        $order = $user->orders()->create([
            'total' => Cart::total(),
            'status' => 'Pending',
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

        $orderProducts = $order->products()->get();
        Mail::to($user)->send(new OrderShipped($orderProducts, $order, $user));

        return back()->with('status', 'Thank you for shopping at Nike! Your order has been received and is going through verification process.');
    }
}
