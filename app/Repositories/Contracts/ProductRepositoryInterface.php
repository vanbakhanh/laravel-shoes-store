<?php

namespace App\Repositories\Contracts;

interface ProductRepositoryInterface
{
    public function uploadImage($request, $product);

    public function createProduct($product, $color, $size);

    public function updateProduct($product, $color, $size, $id);

    public function getProductsSuggestion($productSelected);

    public function getComments($id);

    public function getSelectedColors($product);

    public function getSelectedSizes($product);

    public function getSearchProduct($keyword);

    public function getProductsFollowGenderAndCategory($id, $gender);

    public function deleteProduct($id);
}
