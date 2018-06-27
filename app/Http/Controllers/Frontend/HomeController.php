<?php

namespace App\Http\Controllers\Frontend;

use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Home\SearchRequest;

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
        $products = $this->productRepository->orderBy('created_at')->paginate(24);

        return view('frontend.home.index', compact('products'));
    }

    /**
     * Display products of men follow to category.
     */
    public function men($id)
    {
        $categorySelected = $this->categoryRepository->findOrFail($id);
        $categories = $this->categoryRepository->all()->sortBy('name');
        $products = $this->categoryRepository->findOrFail($id)
        ->products()
        ->where('gender', 'male')
        ->orderBy('created_at')
        ->paginate(24);

        return view('frontend.home.men', compact(['products', 'categorySelected', 'categories']));
    }

    /**
     * Display products of women follow to category.
     */
    public function women($id)
    {
        $categorySelected = $this->categoryRepository->findOrFail($id);
        $categories = $this->categoryRepository->all()->sortBy('name');
        $products = $this->categoryRepository->findOrFail($id)
        ->products()
        ->where('gender', 'female')
        ->orderBy('created_at')
        ->paginate(24);

        return view('frontend.home.women', compact(['products', 'categorySelected', 'categories']));
    }

    /**
     * Search product follow to name.
     */
    public function search(SearchRequest $request)
    {
        $results = $this->productRepository->where('name', 'LIKE', '%' . $request['keyword'] . '%')
        ->orderBy('name')
        ->get()
        ->take(24);
        
        $keyword = $request['keyword'];
        
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
