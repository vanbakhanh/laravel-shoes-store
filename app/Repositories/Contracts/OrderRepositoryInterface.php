<?php

namespace App\Repositories\Contracts;

interface OrderRepositoryInterface
{
    public function findOrder($id);

    public function getOrdersFollowUser();

    public function getOrders($status);

    public function updateStatusOrder($id);

    public function deleteOrder($id);
}
