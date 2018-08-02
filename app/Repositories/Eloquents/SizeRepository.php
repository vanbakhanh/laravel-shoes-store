<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Contracts\SizeRepositoryInterface;
use App\Repositories\BaseRepository;
use App\Models\Size;

class SizeRepository extends BaseRepository implements SizeRepositoryInterface
{
	public function model()
	{
		return Size::class;
	}

	public function createSize($request)
	{
		$this->create($request->only('name'));
	}

	public function updateSize($request, $id)
	{
		$this->findOrFail($id)->update($request->only('name'));
	}
}