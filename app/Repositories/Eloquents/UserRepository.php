<?php

namespace App\Repositories\Eloquents;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Eloquents\BaseRepository;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function model()
    {
        return app(User::class);
    }

    public function updateUser($request, $id)
    {
        return $this->model()->findOrFail($id)->update($request->only('email'));
    }

    public function deleteUser($id)
    {
        $user = $this->model()->findOrFail($id);
        $user->orders()->delete();
        $user->comments()->delete();
        $user->delete();

        return true;
    }

    public function changePassword($request, $id)
    {
        return $this->model()->findOrFail($id)->update(['password' => $request['password']]);
    }

    public function verifyUser($token)
    {
        $user = $this->model()->where('token', $token)->first();
        $user->status = User::ACTIVE;
        $user->token = null;
        $user->save();

        return $user;
    }
}
