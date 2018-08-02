<?php

namespace App\Repositories\Contracts;

interface SizeRepositoryInterface
{
	public function createSize($request);

	public function updateSize($request, $id);
}