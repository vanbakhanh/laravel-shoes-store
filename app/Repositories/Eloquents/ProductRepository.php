<?php

namespace App\Repositories\Eloquents;

use App\Models\Comment;
use App\Models\Product;
use App\Models\Review;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\Eloquents\BaseRepository;
use Storage;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    const PAGINATE = 24;

    public function model()
    {
        return app(Product::class);
    }

    public function uploadImage($request, $product)
    {
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $file) {
                $type = explode('.', $file->getClientOriginalName());
                $type = strtolower(array_pop($type));
                $imageName = now()->format('YmdHs') . uniqid() . '.' . $type;
                Storage::put(config('path.path_upload_product') . $imageName, file_get_contents($file));
                $images[] = $imageName;
            }

            $product['image'] = json_encode($images);
        }

        return $product;
    }

    public function createProduct($product, $color, $size)
    {
        $product = $this->model()->create($product);

        $product->colors()->attach($color);
        $product->sizes()->attach($size);

        return true;
    }

    public function updateProduct($product, $color, $size, $id)
    {
        $oldProduct = $this->model()->findOrFail($id);
        $oldProduct->update($product);

        $oldProduct->colors()->sync($color);
        $oldProduct->sizes()->sync($size);

        return true;
    }

    public function getProductsSuggestion($productSelected)
    {
        return $this->model()->with(['colors', 'sizes'])
            ->where('category_id', $productSelected->category_id)
            ->where('id', '!=', $productSelected->id)
            ->where('gender', $productSelected->gender)
            ->get()
            ->shuffle()
            ->take(6);
    }

    public function getComments($id)
    {
        return Comment::where('product_id', $id)
            ->with('user')
            ->get()
            ->sortByDesc('created_at');
    }

    public function getReviews($id)
    {
        return Review::where('product_id', $id)
            ->with('user.profile')
            ->get()
            ->sortByDesc('created_at');
    }

    public function getSelectedColors($product)
    {
        return $product->colors->pluck('id')->toArray();
    }

    public function getSelectedSizes($product)
    {
        return $product->sizes->pluck('id')->toArray();
    }

    public function getSearchProduct($keyword)
    {
        return $this->model()->where('name', 'LIKE', '%' . $keyword . '%')
            ->with(['colors', 'sizes'])
            ->orderBy('name')
            ->get()
            ->take(self::PAGINATE);
    }

    public function getProductsFollowGenderAndCategory($id, $gender)
    {
        return $this->model()->where('category_id', $id)
            ->where('gender', $gender)
            ->with(['colors', 'sizes', 'category'])
            ->orderBy('created_at', 'desc')
            ->paginate(self::PAGINATE);
    }

    public function deleteProduct($id)
    {
        return $this->model()->findOrFail($id)->delete();
    }
}
