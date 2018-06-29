<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Contracts\OrderRepositoryInterface;
use App\Repositories\BaseRepository;
use App\Models\Order;

class OrderRepository extends BaseRepository implements OrderRepositoryInterface
{
	public function model()
	{
		return Order::class;
	}
}