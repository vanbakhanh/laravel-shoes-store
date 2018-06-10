<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\User\ChangePasswordRequest;
use App\Models\Admin;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;

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
        $user = User::count();
        $category = Category::count();
        $product = Product::count();
        return view('backend/admin/index', compact(['user', 'category', 'product']));
    }

    // Change password
    public function showPasswordForm($id)
    {
        $admin = Admin::findOrFail($id);
        return view('backend.admin.password',compact('admin'));
    }
    public function changePassword(ChangePasswordRequest $request, $id)
    {
        try {
            $admin = Admin::findOrFail($id);
            $admin->password = Hash::make($request['password']);
            $admin->save();
            return redirect()->back()->with('status', 'Password has been changed');
        } catch (\Exception $e) {
            
        }
    }
}
