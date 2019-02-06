<?php

namespace App\Repositories\Contracts;

interface UserRepositoryInterface
{
    public function updateUser($user, $id);

    public function deleteUser($id);

    public function changePassword($password, $id);

    public function verifyUser($token);
}
