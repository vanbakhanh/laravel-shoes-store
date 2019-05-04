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

    public function updateUser($user, $id)
    {
        return $this->model()->findOrFail($id)->update($user);
    }

    public function deleteUser($id)
    {
        return $this->model()->findOrFail($id)->delete();
    }

    public function changePassword($password, $id)
    {
        return $this->model()->findOrFail($id)->update($password);
    }

    public function verifyUser($token)
    {
        $user = $this->model()->where('token', $token)->first();
        $user->status = User::ACTIVE;
        $user->token = null;
        $user->save();

        return $user;
    }

    public function editUser($id)
    {
        return $this->model()->where('id', $id)->with('profile')->first();
    }
}
