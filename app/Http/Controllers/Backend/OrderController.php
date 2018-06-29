<?php

namespace App\Http\Controllers\Backend;

use App\Repositories\Contracts\OrderRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    protected $orderRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(OrderRepositoryInterface $orderRepository) 
    {
        $this->orderRepository = $orderRepository;
    }

    /**
     * Display order of user - user.
     */
    public function index()
    {
    	$orders = $this->orderRepository->ordersWithProduct();

        return view('frontend.order.index', compact('orders'));
    }

    /**
     * Display detail of one order - user.
     */
    public function detail($id)
    {
    	$orders = $this->orderRepository->ordersWithUser();

        $orderDetail = $this->orderRepository->orderWithProduct($id);

        return view('frontend.order.detail', compact([
            'orderDetail', 'orders'
        ]));
    }

    /**
     * Display the view to manager orders - admin.
     */
    public function manager()
    {
        $ordersPending = $this->orderRepository->ordersPending();

        $ordersVerified = $this->orderRepository->ordersVerified();

        return view('backend.order.index', compact([
            'ordersVerified', 'ordersPending'
        ]));
    }

    /**
     * Display the view to manager pending orders - admin.
     */
    public function managerDetailPending($id)
    {
        $ordersPending = $this->orderRepository->ordersPending();

        $orderDetail = $this->orderRepository->orderWithProductUser($id);

        return view('backend.order.detail-pending', compact([
            'ordersPending', 'orderDetail'
        ]));
    }

    /**
     * Display the view to manager verified orders - admin.
     */
    public function managerDetailVerified($id)
    {
        $ordersVerified = $this->orderRepository->ordersVerified();

        $orderDetail = $this->orderRepository->orderWithProductUser($id);

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
            $this->orderRepository->verify($id);
            
            return redirect()->route('order.manager');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Delete order - admin.
     */
    public function destroy($id)
    {
        try {
            $this->orderRepository->delete($id);

            return back()->with('status', 'Delete successful');
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
