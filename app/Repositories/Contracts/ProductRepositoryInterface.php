<?php

namespace App\Repositories\Contracts;

interface ProductRepositoryInterface
{
    public function uploadImage($request, $data);

    public function createProduct($request);

    public function updateProduct($request, $id);

    public function getProductsSuggestion($productSelected);

    public function getComments($id);

    public function getSelectedColors($product);

    public function getSelectedSizes($product);

    public function getSearchProduct($keyword);

    public function getProductsFollowGenderAndCategory($id, $gender);

    public function deleteProduct($id);
}
