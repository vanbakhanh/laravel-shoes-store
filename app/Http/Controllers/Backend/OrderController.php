<?php

namespace App\Http\Controllers\Backend;

use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Contracts\OrderRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class OrderController extends Controller
{
    protected $orderRepository;
    protected $userRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        OrderRepositoryInterface $orderRepository,
        UserRepositoryInterface $userRepository
    ) {
        $this->orderRepository = $orderRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Display order of user - user.
     */
    public function index()
    {
    	$orders = $this->userRepository->findOrFail(Auth::user()->id)
            ->orders()
            ->with('products')
            ->get()
            ->sortByDesc('created_at');

        return view('frontend.order.index', compact('orders'));
    }

    /**
     * Display detail of one order - user.
     */
    public function detail($id)
    {
    	$orders = $this->userRepository->findOrFail(Auth::user()->id)
            ->orders()
            ->get()
            ->sortByDesc('created_at');

    	$orderDetail = $this->orderRepository->where('id', $id)->with('products')->first();

    	return view('frontend.order.detail', compact([
            'orderDetail', 'orders'
        ]));
    }

    /**
     * Display the view to manager orders - admin.
     */
    public function manager()
    {
        $ordersPending = $this->orderRepository->with('user')->where('status', 'Pending')->get();
        $ordersVerified = $this->orderRepository->with('user')->where('status', 'Verified')->get();

        return view('backend.order.index', compact([
            'ordersVerified', 'ordersPending'
        ]));
    }

    /**
     * Display the view to manager pending orders - admin.
     */
    public function managerDetailPending($id)
    {
        $ordersPending = $this->orderRepository->where('status', 'Pending')
            ->get()
            ->take(15)
            ->sortByDesc('created_at');

        $orderDetail = $this->orderRepository->where('id' ,$id)->with('products', 'user')->first();

        return view('backend.order.detail-pending', compact([
            'ordersPending', 'orderDetail'
        ]));
    }

    /**
     * Display the view to manager verified orders - admin.
     */
    public function managerDetailVerified($id)
    {
        $ordersVerified = $this->orderRepository->where('status', 'Verified')
            ->get()
            ->take(15)
            ->sortByDesc('created_at');

        $orderDetail = $this->orderRepository->where('id' ,$id)->with('products', 'user')->first();

        return view('backend.order.detail-verified', compact([
            'ordersVerified', 'orderDetail'
        ]));
    }
    
    /**
     * Verify orders are pending - admin.
     */
    public function verify($id)
    {
        try {
            $this->orderRepository->update($id, ['status' => 'Verified']);
            
            return redirect()->route('admin.order');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
