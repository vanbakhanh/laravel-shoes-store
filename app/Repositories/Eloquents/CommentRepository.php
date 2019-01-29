<?php

namespace App\Repositories\Eloquents;

use App\Models\Comment;
use App\Repositories\BaseRepository;
use App\Repositories\Contracts\CommentRepositoryInterface;

class CommentRepository extends BaseRepository implements CommentRepositoryInterface
{
    public function model()
    {
        return app(Comment::class);
    }

    public function createComment($request)
    {
        return $this->model()->create($request->only('content', 'product_id', 'user_id'));
    }
}
