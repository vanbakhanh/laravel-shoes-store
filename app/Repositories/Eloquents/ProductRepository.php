<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\BaseRepository;
use App\Models\Product;
use App\Models\Category;
use App\Models\Comment;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
	public function model()
	{
		return Product::class;
	}

	public function store($request)
	{
		$imageName = time() . '.' . $request['image']->getClientOriginalExtension();
		$request['image']->move(public_path('images/product'), $imageName);

		$category = Category::findOrFail($request['category']);
		if($category){
			$data = $request->only('name', 'description', 'gender', 'price');
			$data['image'] = $imageName;

			$product = $category->products()->create($data);

			$product->colors()->attach($request['color']);
			$product->sizes()->attach($request['size']);

			return true;
		}

		return false;
	}

	public function update($request, $id)
	{
		if ($request['image']) {
			$imageName = time() . '.' . $request['image']->getClientOriginalExtension();
			$request['image']->move(public_path('images/product'), $imageName);
		}

		$category = Category::findOrFail($request['category_id']);
		if ($category){
			$data = $request->only('name', 'description', 'gender', 'price', 'category_id');
			if ($request['image']) {
				$data['image'] = $imageName;
			}

			$product = $this->findOrFail($id);
			$product->update($data);

			$product->colors()->sync($request['color']);
			$product->sizes()->sync($request['size']);

			return true;
		}

		return false;
	}

	public function productSuggestions($productSelected)
	{
		return Category::findOrFail($productSelected->category_id)
		->products()
		->where('id', '!=', $productSelected->id)
		->where('gender', $productSelected->gender)->get()->shuffle()->take(6);
	}

	public function comments($id)
	{
		return Comment::where('product_id', $id)
		->with('user')
		->get()
		->sortByDesc('created_at');
	}

	public function selectedColors($product)
	{
		return $product->colors->pluck('id')->toArray();
	}

	public function selectedSizes($product)
	{
		return $product->sizes->pluck('id')->toArray();
	}

	public function searchProduct($keyword)
	{
		return $this->where('name', 'LIKE', '%' . $keyword . '%')
		->orderBy('name')
		->get()
		->take(24);
	}

	public function productsFollowGenderAndCategory($id, $gender)
	{
		return Category::findOrFail($id)
		->products()
		->where('gender', $gender)
		->orderBy('created_at', 'desc')
		->paginate(24);
	}
}