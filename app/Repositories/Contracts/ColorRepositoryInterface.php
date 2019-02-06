<?php

namespace App\Repositories\Contracts;

interface ColorRepositoryInterface
{
    public function createColor($color);

    public function updateColor($color, $id);
}
