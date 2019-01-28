<?php

namespace App\Repositories\Contracts;

interface UserRepositoryInterface
{
    public function updateUser($request, $id);

    public function deleteUser($id);

    public function changePassword($request, $id);

    public function verifyUser($token);
}
