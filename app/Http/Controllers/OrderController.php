<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Repositories\Contracts\OrderRepositoryInterface;
use Illuminate\Http\Request;

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
        $orders = $this->orderRepository->getOrdersFollowUser()->take(10);

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
        $ordersPending = $this->orderRepository->getOrders(Order::PENDING)->count();
        $ordersVerified = $this->orderRepository->getOrders(Order::VERIFIED)->count();
        $ordersShipped = $this->orderRepository->getOrders(Order::SHIPPED)->count();
        $ordersCanceled = $this->orderRepository->getOrders(Order::CANCELED)->count();

        return view('backend.order.manager', compact([
            'ordersVerified', 'ordersPending', 'ordersShipped', 'ordersCanceled',
        ]));
    }

    /**
     * Display the view of manager orders follow status - admin.
     */
    public function managerStatus($status)
    {
        $ordersPending = $this->orderRepository->getOrders(Order::PENDING)->count();
        $ordersVerified = $this->orderRepository->getOrders(Order::VERIFIED)->count();
        $ordersShipped = $this->orderRepository->getOrders(Order::SHIPPED)->count();
        $ordersCanceled = $this->orderRepository->getOrders(Order::CANCELED)->count();

        $orders = $this->orderRepository->getOrders(Order::STATUS[$status]);

        return view('backend.order.status', compact([
            'orders', 'status', 'ordersVerified', 'ordersPending', 'ordersShipped', 'ordersCanceled',
        ]));
    }

    /**
     * Display the view of manager orders detail - admin.
     */
    public function managerDetail(Request $request, $id)
    {
        $status = strtolower($request->segment(3));

        if ($this->orderRepository->findOrFail($id)->status !== $status) {
            return back();
        }

        $orders = $this->orderRepository->getOrders(Order::STATUS[$status])->take(10);

        $orderDetail = $this->orderRepository->findOrder($id);

        return view('backend.order.detail', compact([
            'orders', 'orderDetail',
        ]));
    }

    /**
     * Verify orders are pending - admin.
     */
    public function updateStatus($id)
    {
        $status = $this->orderRepository->findOrFail($id)->status;

        $this->orderRepository->updateStatusOrder($id);

        return redirect()
            ->route('order.manager.status', ['status' => $status])
            ->with('status', trans('messages.updated_success'));
    }

    /**
     * Cancel orders - admin.
     */
    public function cancelOrderForAdmin($id)
    {
        $this->orderRepository->cancelOrder($id);

        return redirect()
            ->route('order.manager.status', ['status' => Order::TEXT[Order::PENDING]])
            ->with('status', trans('messages.canceled_success'));
    }

    public function cancelOrderForUser($id)
    {
        $this->orderRepository->cancelOrder($id);

        return redirect()->route('order')->with('status', trans('messages.canceled_success'));
    }

    /**
     * Delete order - admin.
     */
    public function destroy($id)
    {
        $this->orderRepository->deleteOrder($id);

        return back()->with('status', trans('messages.deleted_success'));
    }
}
