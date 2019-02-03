<?php

namespace App\Repositories\Eloquents;

use App\Models\Order;
use App\Models\User;
use App\Repositories\Eloquents\BaseRepository;
use App\Repositories\Contracts\OrderRepositoryInterface;
use Auth;

class OrderRepository extends BaseRepository implements OrderRepositoryInterface
{
    public function model()
    {
        return app(Order::class);
    }

    public function findOrder($id)
    {
        return $this->model()->where('id', $id)->first();
    }

    public function getOrdersFollowUser()
    {
        return User::findOrFail(Auth::user()->id)
            ->orders()
            ->get()
            ->sortByDesc('created_at');
    }

    public function getOrdersPending()
    {
        return $this->model()->with('user')
            ->where('status', Order::PENDING)
            ->get()
            ->sortByDesc('created_at');
    }

    public function getOrdersVerified()
    {
        return $this->model()->with('user')
            ->where('status', Order::VERIFIED)
            ->get()
            ->sortByDesc('created_at');
    }

    public function verifyOrder($id)
    {
        return $this->model()->update($id, ['status' => Order::VERIFIED]);
    }

    public function deleteOrder($id)
    {
        return $this->model()->findOrFail($id)->delete();
    }
}
