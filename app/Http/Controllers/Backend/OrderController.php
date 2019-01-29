<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\OrderRepositoryInterface;

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
        $orders = $this->orderRepository->getOrdersFollowUser();

        $orderDetail = $orders->first();

        return view('frontend.order.index', compact([
            'orderDetail', 'orders',
        ]));
    }

    /**
     * Display detail of one order - user.
     */
    public function detail($id)
    {
        $orders = $this->orderRepository->getOrdersFollowUser();

        $orderDetail = $this->orderRepository->findOrder($id);

        return view('frontend.order.detail', compact([
            'orderDetail', 'orders',
        ]));
    }

    /**
     * Display the view of manager orders - admin.
     */
    public function manager()
    {
        $ordersPending = $this->orderRepository->getOrdersPending();

        $ordersVerified = $this->orderRepository->getOrdersVerified();

        return view('backend.order.index', compact([
            'ordersVerified', 'ordersPending',
        ]));
    }

    /**
     * Display the view of manager pending orders - admin.
     */
    public function managerDetailPending($id)
    {
        $ordersPending = $this->orderRepository->getOrdersPending()->take(15);

        $orderDetail = $this->orderRepository->findOrder($id);

        return view('backend.order.detail_pending', compact([
            'ordersPending', 'orderDetail',
        ]));
    }

    /**
     * Display the view of manager verified orders - admin.
     */
    public function managerDetailVerified($id)
    {
        $ordersVerified = $this->orderRepository->getOrdersVerified()->take(15);

        $orderDetail = $this->orderRepository->findOrder($id);

        return view('backend.order.detail_verified', compact([
            'ordersVerified', 'orderDetail',
        ]));
    }

    /**
     * Verify orders are pending - admin.
     */
    public function verify($id)
    {
        try {
            $this->orderRepository->verifyOrder($id);

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
            $this->orderRepository->findOrFail($id)->delete();

            return back()->with('status', trans('messages.deleted_success'));
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
