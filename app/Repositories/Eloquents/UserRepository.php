<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
	public function model()
	{
		return User::class;
	}

	public function update($request, $id)
	{
		$this->findOrFail($id)->update($request->only(
			'name', 'email', 'address', 'phone', 'birthday', 'gender'
		));
	}

	public function destroy($id)
	{
		$user = $this->findOrFail($id);
		$user->orders()->delete();
		$user->comments()->delete();
		$user->delete();
	}

	public function changePassword($request, $id)
	{
		$this->findOrFail($id)->update(['password' => Hash::make($request['password'])]);
	}
}