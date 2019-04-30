<?php

namespace App\Repositories\Eloquents;

use App\Models\Order;
use App\Models\User;
use App\Repositories\Contracts\OrderRepositoryInterface;
use App\Repositories\Eloquents\BaseRepository;
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

    public function getOrders($status)
    {
        return $this->model()->with('user')
            ->where('status', $status)
            ->get()
            ->sortByDesc('created_at');
    }

    public function updateStatusOrder($id)
    {
        return $this->model()->where('id', $id)->increment('status');
    }

    public function deleteOrder($id)
    {
        return $this->model()->findOrFail($id)->delete();
    }
}
