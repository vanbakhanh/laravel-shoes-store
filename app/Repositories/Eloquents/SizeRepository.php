<?php

namespace App\Repositories\Eloquents;

use App\Models\Size;
use App\Repositories\Eloquents\BaseRepository;
use App\Repositories\Contracts\SizeRepositoryInterface;

class SizeRepository extends BaseRepository implements SizeRepositoryInterface
{
    public function model()
    {
        return app(Size::class);
    }

    public function createSize($request)
    {
        return $this->model()->create($request->only('name'));
    }

    public function updateSize($request, $id)
    {
        return $this->model()->findOrFail($id)->update($request->only('name'));
    }
}
