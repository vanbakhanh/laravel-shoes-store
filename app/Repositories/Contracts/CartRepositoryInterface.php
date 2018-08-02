<?php

namespace App\Repositories\Contracts;

interface CartRepositoryInterface
{
	public function cartContent();

	public function addToCart($request, $product);

	public function updateItem($request);

	public function removeItem($rowId);

	public function checkout();
}