<?php

namespace App\Http\Controllers\Backend;

use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\ColorRepositoryInterface;
use App\Repositories\Contracts\SizeRepositoryInterface;
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

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        ProductRepositoryInterface $productRepository,
        CategoryRepositoryInterface $categoryRepository,
        ColorRepositoryInterface $colorRepository,
        SizeRepositoryInterface $sizeRepository
    ) {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
        $this->colorRepository = $colorRepository;
        $this->sizeRepository = $sizeRepository;
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
            $this->productRepository->store($request);
            
            return back()->with('status', trans('messages.created_success'));
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

        $products = $this->productRepository->productSuggestions($productSelected);

        $categorySelected = $this->categoryRepository->findOrFail($productSelected->category_id);

        $comments = $this->productRepository->comments($id);

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
        $selectedCategory = $this->categoryRepository->findOrFail($product->category_id)->id;

        $colors = $this->colorRepository->all();
        $selectedColors = $this->productRepository->selectedColors($product);

        $sizes = $this->sizeRepository->all();
        $selectedSizes = $this->productRepository->selectedSizes($product);

        return view('backend.product.edit', compact([
            'product', 'colors', 'selectedColors', 'sizes','selectedSizes', 'categories', 'selectedCategory'
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
            $this->productRepository->update($request, $id);

            return back()->with('status', trans('messages.updated_success'));
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
            $this->productRepository->deleteProduct($id);

            return back()->with('delete', trans('messages.deleted_success'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
