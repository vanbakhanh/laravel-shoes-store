<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Contracts\AdminRepositoryInterface;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminRepository extends BaseRepository implements AdminRepositoryInterface
{
	public function model()
	{
		return Admin::class;
	}

	public function changePassword($request, $id)
	{
		$this->update(
			$id, 
			['password' => Hash::make($request['password'])
		]);
	}
}