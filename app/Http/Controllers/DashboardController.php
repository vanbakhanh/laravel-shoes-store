<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\AdminRepositoryInterface;
use App\Repositories\Contracts\OrderRepositoryInterface;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\Contracts\ReviewRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use DB;

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
        $products = $this->productRepository->count();
        $reviews = $this->reviewRepository->count();
        $orders = $this->getOrdersAllData();

        return view('backend.dashboard.index', compact([
            'admins', 'users', 'orders', 'products', 'reviews',
        ]));
    }

    public function getOrdersAllData()
    {
        $allOrders = $this->orderRepository->all();
        $orders['total'] = $allOrders->count();
        $orders['profit'] = $allOrders->sum('total');
        $orders['quantity'] = $allOrders->sum('quantity');

        $orders = $this->getOrdersTotalData($orders);
        $orders = $this->getOrdersProfitData($orders);
        $orders = $this->getOrdersQuantityData($orders);

        return $orders;
    }

    public function getOrdersTotalData($orders)
    {
        $ordersTotalData = DB::table('orders')
            ->select(
                DB::raw("DATE_FORMAT(created_at, '%D %M') as date"),
                DB::raw('count(id) as total')
            )
            ->groupBy('date')
            ->get();
        $ordersTotalData->reverse()->take(7);
        foreach ($ordersTotalData as $data) {
            $orders['chart']['total']['label'][] = $data->date;
            $orders['chart']['total']['data'][] = $data->total;
        }

        return $orders;
    }

    public function getOrdersProfitData($orders)
    {
        $ordersProfitData = DB::table('orders')
            ->select(
                DB::raw("DATE_FORMAT(created_at, '%D %M') as date"),
                DB::raw('sum(total) as total')
            )
            ->groupBy('date')
            ->get();
        $ordersProfitData->reverse()->take(7);
        foreach ($ordersProfitData as $data) {
            $orders['chart']['profit']['label'][] = $data->date;
            $orders['chart']['profit']['data'][] = $data->total;
        }

        return $orders;
    }

    public function getOrdersQuantityData($orders)
    {

        $ordersQuantityData = DB::table('orders')
            ->select(
                DB::raw("DATE_FORMAT(created_at, '%D %M') as date"),
                DB::raw('sum(quantity) as total')
            )
            ->groupBy('date')
            ->get();
        $ordersQuantityData->reverse()->take(7);
        foreach ($ordersQuantityData as $data) {
            $orders['chart']['quantity']['label'][] = $data->date;
            $orders['chart']['quantity']['data'][] = $data->total;
        }

        return $orders;
    }
}
