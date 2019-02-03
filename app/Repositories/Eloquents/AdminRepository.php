<?php

namespace App\Repositories\Eloquents;

use App\Models\Admin;
use App\Repositories\Eloquents\BaseRepository;
use App\Repositories\Contracts\AdminRepositoryInterface;

class AdminRepository extends BaseRepository implements AdminRepositoryInterface
{
    public function model()
    {
        return app(Admin::class);
    }

    public function changePassword($request, $id)
    {
        return $this->model()->update(
            $id,
            ['password' => $request['password']]
        );
    }
}
