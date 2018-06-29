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
	
	public function store($request)
	{
		$this->create($request->only('name'));
	}

	public function update($request, $id)
	{
		$this->findOrFail($id)->update($request->only('name'));
	}
}