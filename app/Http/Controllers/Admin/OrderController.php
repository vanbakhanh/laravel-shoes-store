<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Order;
use Auth;

class OrderController extends Controller
{
    /**
     * Display order of user - user.
     */
    public function index()
    {
    	$orders = User::findOrFail(Auth::user()->id)->orders()->with('products')->get()->sortByDesc('created_at');

        return view('frontend.order.index', compact('orders'));
    }

    /**
     * Display detail of one order - user.
     */
    public function detail($id)
    {
    	$orders = User::findOrFail(Auth::user()->id)->orders()->get()->sortByDesc('created_at');
    	$orderDetail = Order::findOrFail($id)->with('products')->first();

    	return view('frontend.order.detail', compact([
            'orderDetail', 'orders'
        ]));
    }

    /**
     * Display the view to manager orders - admin.
     */
    public function manager()
    {
        $ordersPending = Order::with('user')->where('status', 'Pending')->get();
        $ordersVerified = Order::with('user')->where('status', 'Verified')->get();

        return view('backend.order.index', compact([
            'ordersVerified', 'ordersPending'
        ]));
    }

    /**
     * Display the view to manager pending orders - admin.
     */
    public function managerDetailPending($id)
    {
        $ordersPending = Order::where('status', 'Pending')->get()->take(15)->sortByDesc('created_at');
        $orderDetail = Order::findOrFail($id)->with('products', 'user')->first();

        return view('backend.order.detail-pending', compact([
            'ordersPending', 'orderDetail'
        ]));
    }

    /**
     * Display the view to manager verified orders - admin.
     */
    public function managerDetailVerified($id)
    {
        $ordersVerified = Order::where('status', 'Verified')->get()->take(15)->sortByDesc('created_at');
        $orderDetail = Order::findOrFail($id)->with('products', 'user')->first();;

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
            Order::findOrFail($id)->update(['status' => 'Verified']);
            
            return redirect()->route('admin.order');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
