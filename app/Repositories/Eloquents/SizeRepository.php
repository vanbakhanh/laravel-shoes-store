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
}