<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Product\ProductStoreRequest;
use App\Http\Requests\Product\ProductUpdateRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Color;
use App\Models\Size;
use App\Models\Comment;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();

        return view('backend.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $colors = Color::pluck('name', 'id');
        $sizes = Size::pluck('name', 'id');

        return view('backend.product.create',compact(['categories', 'colors', 'sizes']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductStoreRequest $request)
    {
        try {
            $imageName = time() . '.' . $request['image']->getClientOriginalExtension();
            $request['image']->move(public_path('images/product'), $imageName);

            $category = Category::findOrFail($request['category']);
            if($category){
                $data = $request->only('name', 'description', 'gender', 'price');
                $data['image'] = $imageName;

                $product = $category->products()->create($data);
                $product->colors()->attach($request['color']);
                $product->sizes()->attach($request['size']);
            }
            
            return back()->with('status', 'Create successful');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $productSelected = Product::findOrFail($id);

        $products = Category::findOrFail($productSelected->category_id)
            ->products()
            ->where('id', '!=', $productSelected['id'])
            ->where('gender', $productSelected->gender)->get()->shuffle()->take(4);

        $categorySelected = Category::find($productSelected->category_id);

        $comments = Comment::where('product_id', $id)->with('user')->get()->sortByDesc('created_at');

        return view('frontend.product.show', compact(['productSelected', 'products', 'comments', 'categorySelected']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);

        $categories = Category::all();
        $selectedCategories = Category::findOrFail($product->category_id)->id;

        $colors = Color::all();
        $selectedColors = $product->colors->pluck('id')->toArray();

        $sizes = Size::all();
        $selectedSizes = $product->sizes->pluck('id')->toArray();

        return view('backend.product.edit', compact(['product', 'colors', 'selectedColors', 'sizes','selectedSizes', 'categories', 'selectedCategories']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductUpdateRequest $request, $id)
    {
        try {
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

                $product = Product::findOrFail($id);
                $product->update($data);
                
                $product->colors()->sync($request['color']);
                $product->sizes()->sync($request['size']);
            }

            return back()->with('status', 'Update successful');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Product::findOrFail($id)->delete();

            return back()->with('delete', 'Delete successful');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
