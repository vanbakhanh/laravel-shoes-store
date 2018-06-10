<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Home\SearchRequest;
use App\Models\Product;
use App\Models\Category;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

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

    public function men($id)
    {
        $categorySelected = Category::findOrFail($id);
        $categories = Category::all()->sortBy('name');
        $products = Category::findOrFail($id)->products()->where('gender', 'male')->orderBy('created_at')->paginate(24);
        return view('frontend.home.men', compact(['products', 'categorySelected', 'categories']));
    }

    public function women($id)
    {
        $categorySelected = Category::findOrFail($id);
        $categories = Category::all()->sortBy('name');
        $products = Category::findOrFail($id)->products()->where('gender', 'female')->orderBy('created_at')->paginate(24);
        return view('frontend.home.women', compact(['products', 'categorySelected', 'categories']));
    }

    public function search(SearchRequest $request)
    {
        $results = Product::where('name', 'LIKE', '%' . $request['keyword'] . '%')->orderBy('name')->get()->take(24);
        $keyword = $request['keyword'];
        return view('frontend.home.search', compact(['results', 'keyword']));
    }

    public function changeLanguage($language)
    {
        \Session::put('website_language', $language);
        return redirect()->back();
    }
}
