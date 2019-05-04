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
        $user = auth()->user();

        $oldReview = $user->reviews()->where('product_id', $review['product_id'])->exists();

        if ($oldReview) {
            return $user->reviews()->where('product_id', $review['product_id'])->update($review);
        }

        return $user->reviews()->create($review);
    }
}
