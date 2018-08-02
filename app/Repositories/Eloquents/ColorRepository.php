<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Contracts\ColorRepositoryInterface;
use App\Repositories\BaseRepository;
use App\Models\Color;

class ColorRepository extends BaseRepository implements ColorRepositoryInterface
{
	public function model()
	{
		return Color::class;
	}
	
	public function createColor($request)
	{
		$this->create($request->only('name'));
	}

	public function updateColor($request, $id)
	{
		$this->findOrFail($id)->update($request->only('name'));
	}
}