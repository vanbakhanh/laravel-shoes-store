<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\User\UserUpdateRequest;
use App\Http\Requests\User\ChangePasswordRequest;
use App\Models\User;
use Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return view('backend.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        if (Auth::check()) {
            $user = User::findOrFail(Auth::user()->id);

            return view('frontend.user.edit', compact('user'));
        }
        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request)
    {
        try {
            $user = User::findOrFail(Auth::user()->id);
            $user->update($request->only('name', 'email', 'address', 'phone', 'birthday', 'gender'));

            return back()->with('status', 'Update successful');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->orders()->delete();
            $user->comments()->delete();
            $user->delete();

            return back()->with('status', 'Delete successful');
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Change password.
     */
    public function showPasswordForm()
    {
        if (Auth::check()) {
            $user = User::findOrFail(Auth::user()->id);

            return view('frontend.user.password', compact('user'));
        }
        return redirect()->back();
    }
    
    public function changePassword(ChangePasswordRequest $request)
    {
        try {
            $user = User::findOrFail(Auth::user()->id);
            $user->password = Hash::make($request['password']);
            $user->save();

            return back()->with('status', 'Password has been changed');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
