<?php

namespace App\Repositories\Contracts;

interface CategoryRepositoryInterface
{
    public function createCategory($category);

    public function updateCategory($category, $id);

    public function deleteCategory($id);
}
