<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\ProductRepositoryInterface;

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
        $products = $this->productRepository->with(['colors', 'sizes'])->orderBy('created_at', 'desc')->paginate(24);

        return view('frontend.home.index', compact('products'));
    }

    /**
     * Display products of men follow to category.
     */
    public function men($id)
    {
        $gender = 'male';

        $categories = $this->categoryRepository->orderBy('name')->get();
        $products = $this->productRepository->getProductsFollowGenderAndCategory($id, $gender);

        return view('frontend.home.men', compact(['products', 'categories']));
    }

    /**
     * Display products of women follow to category.
     */
    public function women($id)
    {
        $gender = 'female';

        $categories = $this->categoryRepository->orderBy('name')->get();
        $products = $this->productRepository->getProductsFollowGenderAndCategory($id, $gender);

        return view('frontend.home.women', compact(['products', 'categories']));
    }

    /**
     * Search product follow to name.
     */
    public function search()
    {
        $keyword = $_GET['keyword'];

        $results = $this->productRepository->getSearchProduct($keyword);

        return view('frontend.home.search', compact(['results', 'keyword']));
    }

    /**
     * Change language.
     */
    public function changeLanguage($language)
    {
        \Session::put('website_language', $language);

        return back();
    }
}
