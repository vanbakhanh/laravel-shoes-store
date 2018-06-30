<?php

namespace App\Http\Controllers\Frontend;

use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\Contracts\CartRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    protected $cartRepository;
    protected $productRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        CartRepositoryInterface $cartRepository,
        ProductRepositoryInterface $productRepository
    ) {
        $this->cartRepository = $cartRepository;
        $this->productRepository = $productRepository;
    }

    /**
     * Display cart.
     */
    public function index()
    {
    	$items = $this->cartRepository->cartContent();

    	return view('frontend.cart.index', compact('items'));
    }

    /**
     * Add to cart.
     */
    public function addItem(Request $request)
    {
    	$product = $this->productRepository->findOrFail($request->productId);
        $this->cartRepository->addToCart($request, $product);

        return back();
    }

    /**
     * Update cart.
     */
    public function update(Request $request)
    {
        $this->cartRepository->updateItem($request);

        return back();
    }

    /**
     * Remove item in cart.
     */
    public function removeItem($rowId)
    {
    	$this->cartRepository->removeItem($rowId);

    	return back();
    }

    /**
     * Checkout and send mail to user.
     */
    public function checkout()
    {
        $this->cartRepository->checkout();

        return back()->with('status', 'Thank you for shopping at Nike! Your order has been received and is going through verification process.');
    }
}
