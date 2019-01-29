<?php

namespace App\Repositories\Contracts;

interface BaseRepositoryInterface
{
    public function model();

    public function setGuard();
}
