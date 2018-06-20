<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\User\ChangePasswordRequest;
use App\Models\Admin;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use Auth;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::count();
        $orders = Order::count();
        $products = Product::count();
        
        return view('backend/admin/index', compact([
            'users', 'orders', 'products'
        ]));
    }

    /**
     * Change password.
     */
    public function showPasswordForm()
    {
        if (Auth::check()) {
            $admin = Admin::findOrFail(Auth::user()->id);

            return view('backend.admin.password',compact('admin'));
        }
        return back();
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        try {
            $admin = Admin::findOrFail(Auth::user()->id);
            $admin->password = Hash::make($request['password']);
            $admin->save();

            return back()->with('status', 'Password has been changed');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
