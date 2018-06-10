<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Order;
use Auth;

class OrderController extends Controller
{
    public function index()
    {
    	$orders = User::findOrFail(Auth::user()->id)->orders()->with('products')->get()->sortByDesc('created_at');
        return view('frontend.order.index', compact('orders'));
    }

    public function detail($id)
    {
    	$orders = User::findOrFail(Auth::user()->id)->orders()->get()->sortByDesc('created_at');
    	$orderDetail = Order::findOrFail($id);
        $orderProducts = $orderDetail->products()->get();
    	return view('frontend.order.detail', compact(['orderDetail', 'orders', 'orderProducts']));
    }

    public function manager()
    {
        $orders = Order::all();
        return view('backend.order.index', compact('orders'));
    }

    public function managerDetailPending($id)
    {
        $ordersPending = Order::where('status', 'Pending')->get()->take(15)->sortByDesc('created_at');
        $orderDetail = Order::findOrFail($id);
        $orderProducts = $orderDetail->products()->get();
        $user = User::findOrFail($orderDetail->user_id);
        return view('backend.order.detailPending', compact(['orderProducts', 'ordersPending', 'orderDetail', 'user']));
    }

    public function managerDetailVerified($id)
    {
        $ordersVerified = Order::where('status', 'Verified')->get()->take(15)->sortByDesc('created_at');
        $orderDetail = Order::findOrFail($id);
        $orderProducts = $orderDetail->products()->get();
        $user = User::findOrFail($orderDetail->user_id);
        return view('backend.order.detailVerified', compact(['orderProducts', 'ordersVerified', 'orderDetail', 'user']));
    }
    
    public function verify($id)
    {
        try {
            Order::findOrFail($id)->update(['status' => 'Verified']);
            return redirect()->route('admin.order');
        } catch (\Exception $e) {
            
        }
    }
}
