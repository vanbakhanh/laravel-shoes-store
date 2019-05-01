<?php

namespace App\Repositories\Eloquents;

use App\Models\Category;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Eloquents\BaseRepository;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    public function model()
    {
        return app(Category::class);
    }

    public function createCategory($category)
    {
        return $this->model()->create($category);
    }

    public function updateCategory($category, $id)
    {
        return $this->model()->findOrFail($id)->update($category);
    }

    public function deleteCategory($id)
    {
        return $this->model()->findOrFail($id)->delete();
    }
}
