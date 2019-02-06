<?php

namespace App\Repositories\Eloquents;

use App\Models\Size;
use App\Repositories\Contracts\SizeRepositoryInterface;
use App\Repositories\Eloquents\BaseRepository;

class SizeRepository extends BaseRepository implements SizeRepositoryInterface
{
    public function model()
    {
        return app(Size::class);
    }

    public function createSize($size)
    {
        return $this->model()->create($size);
    }

    public function updateSize($size, $id)
    {
        return $this->model()->findOrFail($id)->update($size);
    }
}
