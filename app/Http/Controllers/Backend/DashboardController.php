<?php

namespace App\Http\Controllers\Backend;

use App\Repositories\Contracts\AdminRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\Contracts\OrderRepositoryInterface;
use App\Repositories\Contracts\CommentRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    protected $adminRepository;
    protected $userRepository;
    protected $productRepository;
    protected $orderRepository;
    protected $commentRepository;

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
        CommentRepositoryInterface $commentRepository
    ) {
        $this->middleware('auth:admin');
        $this->adminRepository = $adminRepository;
        $this->userRepository = $userRepository;
        $this->productRepository = $productRepository;
        $this->orderRepository = $orderRepository;
        $this->commentRepository = $commentRepository;
    }

    public function index()
    {
    	$admins = $this->adminRepository->count();
        $users = $this->userRepository->count();
        $orders = $this->orderRepository->all();
        $products = $this->productRepository->count();
        $comments = $this->commentRepository->count();
        
        return view('backend/dashboard/index', compact([
            'admins', 'users', 'orders', 'products', 'comments'
        ]));
    }
}
