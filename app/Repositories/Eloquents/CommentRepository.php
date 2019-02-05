<?php

namespace App\Repositories\Eloquents;

use App\Models\Comment;
use App\Repositories\Contracts\CommentRepositoryInterface;
use App\Repositories\Eloquents\BaseRepository;

class CommentRepository extends BaseRepository implements CommentRepositoryInterface
{
    public function model()
    {
        return app(Comment::class);
    }

    public function createComment($comment)
    {

        return $this->model()->create($comment);
    }
}
