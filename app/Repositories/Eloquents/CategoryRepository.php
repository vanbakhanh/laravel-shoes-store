<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\BaseRepository;
use App\Models\Category;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
	public function model()
	{
		return Category::class;
	}

	public function store($request)
	{
		$this->create($request->only('name', 'description'));
	}

	public function update($request, $id)
	{
		$this->findOrFail($id)->update($request->only('name', 'description'));
	}

	public function destroy($id)
	{
		$category = $this->findOrFail($id);
		$category->products()->delete();
		$category->delete();
	}
}