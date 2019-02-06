<?php

namespace App\Repositories\Contracts;

interface SizeRepositoryInterface
{
    public function createSize($size);

    public function updateSize($size, $id);
}
