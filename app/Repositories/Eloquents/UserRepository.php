<?php

namespace App\Repositories\Eloquents;

use App\Models\User;
use App\Repositories\BaseRepository;
use App\Repositories\Contracts\UserRepositoryInterface;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function model()
    {
        return User::class;
    }

    public function updateUser($request, $id)
    {
        $this->findOrFail($id)->update($request->only(
            'name', 'email', 'address', 'phone', 'birthday', 'gender'
        ));
    }

    public function deleteUser($id)
    {
        $user = $this->findOrFail($id);
        $user->orders()->delete();
        $user->comments()->delete();
        $user->delete();
    }

    public function changePassword($request, $id)
    {
        $this->findOrFail($id)->update(['password' => $request['password']]);
    }

    public function verifyUser($token)
    {
        $user = $this->where('token', $token)->first();
        $user->status = '1';
        $user->save();

        return $user;
    }
}
