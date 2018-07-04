<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Contracts\CartRepositoryInterface;
use App\Mail\OrderShipped;
use Cart;
use Auth;
use Mail;

class CartRepository implements CartRepositoryInterface
{
	public function cartContent()
	{
		return Cart::content();
	}

	public function addToCart($request, $product)
	{
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
	}

	public function updateItem($request)
	{
		Cart::update($request->rowId, $request->qty);
	}

	public function removeItem($rowId)
	{
		Cart::remove($rowId);
	}

	public function checkout()
	{
		$user = Auth::user();
		
		$order = $user->orders()->create([
			'total' => Cart::total(2, '.', ''),
			'status' => 'Pending',
			'quantity' => Cart::count(),
			'address' => $user->address,
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
	}
}