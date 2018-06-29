<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Contracts\AdminRepositoryInterface;
use App\Repositories\BaseRepository;
use App\Models\Admin;

class AdminRepository extends BaseRepository implements AdminRepositoryInterface
{
	public function model()
	{
		return Admin::class;
	}
}