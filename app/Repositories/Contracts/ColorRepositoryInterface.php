<?php

namespace App\Repositories\Contracts;

interface ColorRepositoryInterface
{
    public function createColor($request);

    public function updateColor($request, $id);
}
