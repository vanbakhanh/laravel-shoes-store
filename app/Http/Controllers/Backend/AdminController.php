<?php

namespace App\Http\Controllers\Backend;

use App\Repositories\Contracts\AdminRepositoryInterface;
use App\Http\Requests\User\ChangePasswordRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Auth;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;

class AdminController extends Controller
{
    protected $adminRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(AdminRepositoryInterface $adminRepository)
    {
        $this->middleware('auth:admin');
        $this->adminRepository = $adminRepository;
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
     * Show password form.
     */
    public function showPasswordForm()
    {
        if (Auth::check()) {
            $admin = $this->adminRepository->findOrFail(Auth::user()->id);

            return view('backend.admin.password',compact('admin'));
        }
        
        return back();
    }

    /**
     * Change password.
     */
    public function changePassword(ChangePasswordRequest $request)
    {
        try {
            $admin = $this->adminRepository->findOrFail(Auth::user()->id);
            $admin->password = Hash::make($request['password']);
            $admin->save();

            return back()->with('status', 'Password has been changed');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
