<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Home\SearchRequest;
use App\Models\Product;
use App\Models\Category;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('created_at')->paginate(24);

        return view('frontend.home.index', compact('products'));
    }

    /**
     * Display products of men follow to category.
     */
    public function men($id)
    {
        $categorySelected = Category::findOrFail($id);
        $categories = Category::all()->sortBy('name');
        $products = Category::findOrFail($id)->products()->where('gender', 'male')->orderBy('created_at')->paginate(24);

        return view('frontend.home.men', compact(['products', 'categorySelected', 'categories']));
    }

    /**
     * Display products of women follow to category.
     */
    public function women($id)
    {
        $categorySelected = Category::findOrFail($id);
        $categories = Category::all()->sortBy('name');
        $products = Category::findOrFail($id)->products()->where('gender', 'female')->orderBy('created_at')->paginate(24);

        return view('frontend.home.women', compact(['products', 'categorySelected', 'categories']));
    }

    /**
     * Search product follow to name.
     */
    public function search(SearchRequest $request)
    {
        $results = Product::where('name', 'LIKE', '%' . $request['keyword'] . '%')->orderBy('name')->get()->take(24);
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
