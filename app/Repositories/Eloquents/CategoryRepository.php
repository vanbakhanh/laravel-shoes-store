<?php

namespace App\Repositories\Eloquents;

use App\Models\Category;
use App\Repositories\BaseRepository;
use App\Repositories\Contracts\CategoryRepositoryInterface;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    public function model()
    {
        return app(Category::class);
    }

    public function createCategory($request)
    {
        return $this->model()->create($request->only('name', 'description'));
    }

    public function updateCategory($request, $id)
    {
        return $this->model()->update($id, $request->only('name', 'description'));
    }

    public function deleteCategory($id)
    {
        $category = $this->model()->findOrFail($id);
        $category->products()->delete();
        $category->delete();

        return true;
    }
}
