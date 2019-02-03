<?php

namespace App\Repositories\Eloquents;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Product;
use App\Repositories\Eloquents\BaseRepository;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Storage;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    const PAGINATE = 24;

    public function model()
    {
        return app(Product::class);
    }

    public function uploadImage($request, $data)
    {
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $file) {
                $type = explode('.', $file->getClientOriginalName());
                $type = strtolower(array_pop($type));
                $imageName = now()->format('YmdHs') . uniqid() . '.' . $type;
                Storage::put(config('path.path_upload_product') . $imageName, file_get_contents($file));
                $images[] = $imageName;
            }

            $data['image'] = json_encode($images);
        }

        return $data;
    }

    public function createProduct($request)
    {
        $category = Category::findOrFail($request['category']);

        if ($category) {
            $data = $request->only('name', 'description', 'gender', 'price');
            $data = $this->model()->uploadImage($request, $data);

            $product = $category->products()->create($data);

            $product->colors()->attach($request['color']);
            $product->sizes()->attach($request['size']);

            return true;
        }

        return false;
    }

    public function updateProduct($request, $id)
    {
        $category = Category::findOrFail($request['category_id']);

        if ($category) {
            $data = $request->only('name', 'description', 'gender', 'price', 'category_id');
            $data = $this->model()->uploadImage($request, $data);

            $product = $this->model()->findOrFail($id);
            $product->update($data);

            $product->colors()->sync($request['color']);
            $product->sizes()->sync($request['size']);

            return true;
        }

        return false;
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
