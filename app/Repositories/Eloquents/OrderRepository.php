<?php

namespace App\Repositories\Eloquents;

use App\Models\Order;
use App\Models\User;
use App\Repositories\BaseRepository;
use App\Repositories\Contracts\OrderRepositoryInterface;
use Auth;

class OrderRepository extends BaseRepository implements OrderRepositoryInterface
{
    public function model()
    {
        return Order::class;
    }

    public function findOrder($id)
    {
        return $this->where('id', $id)->first();
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
        return $this->with('user')->where('status', 'Pending')->get()->sortByDesc('created_at');
    }

    public function getOrdersVerified()
    {
        return $this->with('user')->where('status', 'Verified')->get()->sortByDesc('created_at');
    }

    public function verifyOrder($id)
    {
        return $this->update($id, ['status' => 'Verified']);
    }
}
