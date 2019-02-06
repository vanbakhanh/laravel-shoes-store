<?php

namespace App\Repositories\Eloquents;

use App\Models\Color;
use App\Repositories\Contracts\ColorRepositoryInterface;
use App\Repositories\Eloquents\BaseRepository;

class ColorRepository extends BaseRepository implements ColorRepositoryInterface
{
    public function model()
    {
        return app(Color::class);
    }

    public function createColor($color)
    {
        return $this->model()->create($color);
    }

    public function updateColor($color, $id)
    {
        return $this->model()->findOrFail($id)->update($color);
    }
}
