<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class AdminLoginController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin', ['except' => ['logout']]);
    }

    /**
     * Show admin login form.
     */
    public function showLoginForm()
    {
        return view('auth.admin-login');
    }

    /**
     * Admin login.
     */
    public function login(Request $request)
    {
        // Validate the form data
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Attempt to log the user in.
        if (Auth::guard('admin')->attempt(
            ['email' => $request->email, 'password' => $request->password], $request->remember
        )) {
            // If successful, then redirect to their intended location.
            return redirect()->route('dashboard.index');
        }

        // If unsuccessful, then redirect back to the login with the form data.
        return redirect()->back()->withInput($request->only('email', 'remember'));
    }

    /**
     * Admin logout.
     */
    public function logout()
    {
        Auth::guard('admin')->logout();
        
        return redirect('/');
    }
}
