<?php

namespace App\Repositories\Eloquents;

use App\Models\Color;
use App\Repositories\BaseRepository;
use App\Repositories\Contracts\ColorRepositoryInterface;

class ColorRepository extends BaseRepository implements ColorRepositoryInterface
{
    public function model()
    {
        return app(Color::class);
    }

    public function createColor($request)
    {
        return $this->model()->create($request->only('name'));
    }

    public function updateColor($request, $id)
    {
        return $this->model()->findOrFail($id)->update($request->only('name'));
    }
}
