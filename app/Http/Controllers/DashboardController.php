<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\AdminRepositoryInterface;
use App\Repositories\Contracts\ReviewRepositoryInterface;
use App\Repositories\Contracts\OrderRepositoryInterface;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;

class DashboardController extends Controller
{
    protected $adminRepository;
    protected $userRepository;
    protected $productRepository;
    protected $orderRepository;
    protected $reviewRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        AdminRepositoryInterface $adminRepository,
        UserRepositoryInterface $userRepository,
        ProductRepositoryInterface $productRepository,
        OrderRepositoryInterface $orderRepository,
        ReviewRepositoryInterface $reviewRepository
    ) {
        $this->middleware('auth:admin');
        $this->adminRepository = $adminRepository;
        $this->userRepository = $userRepository;
        $this->productRepository = $productRepository;
        $this->orderRepository = $orderRepository;
        $this->reviewRepository = $reviewRepository;
    }

    public function index()
    {
        $admins = $this->adminRepository->count();
        $users = $this->userRepository->count();
        $orders = $this->orderRepository->all();
        $products = $this->productRepository->count();
        $reviews = $this->reviewRepository->count();

        return view('backend/dashboard/index', compact([
            'admins', 'users', 'orders', 'products', 'reviews',
        ]));
    }
}
