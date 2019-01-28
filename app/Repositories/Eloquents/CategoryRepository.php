<?php

namespace App\Repositories\Eloquents;

use App\Models\Category;
use App\Repositories\BaseRepository;
use App\Repositories\Contracts\CategoryRepositoryInterface;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    public function model()
    {
        return Category::class;
    }

    public function createCategory($request)
    {
        $this->create($request->only('name', 'description'));
    }

    public function updateCategory($request, $id)
    {
        $this->update($id, $request->only('name', 'description'));
    }

    public function deleteCategory($id)
    {
        $category = $this->findOrFail($id);
        $category->products()->delete();
        $category->delete();
    }
}
