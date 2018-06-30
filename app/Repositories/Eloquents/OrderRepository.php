<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Contracts\OrderRepositoryInterface;
use App\Repositories\BaseRepository;
use App\Models\Order;
use App\Models\User;
use Auth;

class OrderRepository extends BaseRepository implements OrderRepositoryInterface
{
	public function model()
	{
		return Order::class;
	}

	public function ordersWithProduct()
	{
		return $this->findOrFail(Auth::user()->id)
		->orders()
		->with('products')
		->get()
		->sortByDesc('created_at');
	}

	public function ordersWithUser()
	{
		return User::findOrFail(Auth::user()->id)
		->orders()
		->get()
		->sortByDesc('created_at');
	}

	public function orderWithProduct($id)
	{
		return $this->where('id', $id)->with('products')->first();
	}

	public function orderWithProductUser($id)
	{
		return $this->where('id' ,$id)->with('products', 'user')->first();
	}

	public function ordersPending()
	{
		return $this->with('user')->where('status', 'Pending')->get()->sortByDesc('created_at');
	}

	public function ordersVerified()
	{
		return $this->with('user')->where('status', 'Verified')->get()->sortByDesc('created_at');
	}

	public function verify($id)
	{
		return $this->update($id, ['status' => 'Verified']);
	}
}