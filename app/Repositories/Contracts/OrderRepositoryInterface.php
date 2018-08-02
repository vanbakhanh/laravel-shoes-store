<?php

namespace App\Repositories\Contracts;

interface OrderRepositoryInterface
{
	public function findOrder($id);

	public function getOrdersFollowUser();

	public function getOrdersPending();

	public function getOrdersVerified();

	public function verifyOrder($id);
}