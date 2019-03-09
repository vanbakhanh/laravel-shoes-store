<?php

namespace App\Repositories\Eloquents;

use App\Models\Review;
use App\Repositories\Contracts\ReviewRepositoryInterface;
use App\Repositories\Eloquents\BaseRepository;

class ReviewRepository extends BaseRepository implements ReviewRepositoryInterface
{
    public function model()
    {
        return app(Review::class);
    }

    public function createReview($review)
    {
        $this->model()->create($review);
    }
}
