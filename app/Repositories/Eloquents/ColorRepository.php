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
}