<?php

namespace App\Repositories\Contracts;

interface AdminRepositoryInterface
{
    public function changePassword($password, $id);
}
