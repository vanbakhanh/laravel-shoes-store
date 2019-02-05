<?php

namespace App\Repositories\Eloquents;

use App\Models\Profile;
use App\Repositories\Contracts\ProfileRepositoryInterface;
use App\Repositories\Eloquents\BaseRepository;

class ProfileRepository extends BaseRepository implements ProfileRepositoryInterface
{
    public function model()
    {
        return app(Profile::class);
    }

    public function updateProfile($profile, $id)
    {
        return $this->model()->findOrFail($id)->update($profile);
    }
}
