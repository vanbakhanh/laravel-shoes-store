<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Contracts\CommentRepositoryInterface;
use App\Repositories\BaseRepository;
use App\Models\Comment;
use App\Models\User;

class CommentRepository extends BaseRepository implements CommentRepositoryInterface
{
	public function model()
	{
		return Comment::class;
	}

	public function createComment($request)
	{
		$this->create($request->only('content', 'product_id', 'user_id'));
	}
}