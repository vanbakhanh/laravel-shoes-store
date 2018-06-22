<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\ColorRepositoryInterface;
use App\Repositories\Contracts\SizeRepositoryInterface;
use App\Repositories\Contracts\CommentRepositoryInterface;
use App\Http\Requests\Product\ProductStoreRequest;
use App\Http\Requests\Product\ProductUpdateRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    protected $productRepository;
    protected $categoryRepository;
    protected $colorRepository;
    protected $sizeRepository;
    protected $commentRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        ProductRepositoryInterface $productRepository,
        CategoryRepositoryInterface $categoryRepository,
        ColorRepositoryInterface $colorRepository,
        SizeRepositoryInterface $sizeRepository,
        CommentRepositoryInterface $commentRepository
    ) {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
        $this->colorRepository = $colorRepository;
        $this->sizeRepository = $sizeRepository;
        $this->commentRepository = $commentRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->productRepository->all();

        return view('backend.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->categoryRepository->all();
        $colors = $this->colorRepository->pluck('name', 'id');
        $sizes = $this->sizeRepository->pluck('name', 'id');

        return view('backend.product.create', compact([
            'categories', 'colors', 'sizes'
        ]));
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

            $category = $this->categoryRepository->findOrFail($request['category']);
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
        $productSelected = $this->productRepository->findOrFail($id);

        $products = $this->categoryRepository->findOrFail($productSelected->category_id)
            ->products()
            ->where('id', '!=', $productSelected['id'])
            ->where('gender', $productSelected->gender)->get()->shuffle()->take(4);

        $categorySelected = $this->categoryRepository->find($productSelected->category_id);

        $comments = $this->commentRepository->where('product_id', $id)->with('user')->get()->sortByDesc('created_at');

        return view('frontend.product.show', compact([
            'productSelected', 'products', 'comments', 'categorySelected'
        ]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = $this->productRepository->findOrFail($id);

        $categories = $this->categoryRepository->all();
        $selectedCategories = $this->categoryRepository->findOrFail($product->category_id)->id;

        $colors = $this->colorRepository->all();
        $selectedColors = $product->colors->pluck('id')->toArray();

        $sizes = $this->sizeRepository->all();
        $selectedSizes = $product->sizes->pluck('id')->toArray();

        return view('backend.product.edit', compact([
            'product', 'colors', 'selectedColors', 'sizes','selectedSizes', 'categories', 'selectedCategories'
        ]));
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

            $category = $this->categoryRepository->findOrFail($request['category_id']);
            if ($category){
                $data = $request->only('name', 'description', 'gender', 'price', 'category_id');
                if ($request['image']) {
                    $data['image'] = $imageName;
                }

                $product = $this->productRepository->findOrFail($id);
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
            $this->productRepository->findOrFail($id)->delete();

            return back()->with('delete', 'Delete successful');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
