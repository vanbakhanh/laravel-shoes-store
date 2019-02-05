<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\ChangePasswordRequest;
use App\Repositories\Contracts\AdminRepositoryInterface;
use Auth;

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
        $admins = $this->adminRepository->all();

        return view('backend.admin.index', compact('admins'));
    }

    /**
     * Show password form.
     */
    public function showPasswordForm($id)
    {
        if (Auth::check() && Auth::user()->id == $id) {
            $admin = $this->adminRepository->findOrFail($id);

            return view('backend.admin.password', compact('admin'));
        }

        return back();
    }

    /**
     * Change password.
     */
    public function changePassword(ChangePasswordRequest $request, $id)
    {
        try {
            $this->adminRepository->changePassword($request, $id);

            return back()->with('status', trans('messages.changed_password'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
