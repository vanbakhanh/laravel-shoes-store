<?php

namespace App\Repositories\Eloquents;

use App\Models\Admin;
use App\Repositories\Contracts\AdminRepositoryInterface;
use App\Repositories\Eloquents\BaseRepository;

class AdminRepository extends BaseRepository implements AdminRepositoryInterface
{
    public function model()
    {
        return app(Admin::class);
    }

    public function changePassword($password, $id)
    {
        return $this->model()->findOrFail($id)->update($password);
    }
}
