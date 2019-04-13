<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Session;

class HomeController extends Controller
{
    protected $productRepository;
    protected $categoryRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        ProductRepositoryInterface $productRepository,
        CategoryRepositoryInterface $categoryRepository
    ) {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->productRepository->with(['category', 'reviews'])->orderBy('created_at', 'desc')->paginate(24);

        return view('frontend.home.index', compact('products'));
    }

    /**
     * Display products of gender follow to category.
     */
    protected function getProductsFollowGender($id, $gender)
    {
        $categories = $this->categoryRepository->orderBy('name')->get();
        $categorySelected = $this->categoryRepository->findOrFail($id);
        $products = $this->productRepository->getProductsFollowGenderAndCategory($id, $gender);

        return view('frontend.home.' . Product::GENDER_TEXT[$gender], compact(['products', 'categories', 'categorySelected']));
    }

    /**
     * Display products of men follow to category.
     */
    public function men($id)
    {
        return $this->getProductsFollowGender($id, Product::MEN);
    }

    /**
     * Display products of women follow to category.
     */
    public function women($id)
    {
        return $this->getProductsFollowGender($id, Product::WOMEN);
    }

    /**
     * Search product follow to name.
     */
    public function search()
    {
        $keyword = $_GET['keyword'];

        $products = $this->productRepository->getSearchProduct($keyword);

        return view('frontend.home.search', compact(['products', 'keyword']));
    }

    /**
     * Change language.
     */
    public function changeLanguage($language)
    {
        Session::put('website_language', $language);

        return back();
    }
}
