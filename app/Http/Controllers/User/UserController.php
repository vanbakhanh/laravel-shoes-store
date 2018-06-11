<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\User\UserUpdateRequest;
use App\Http\Requests\User\ChangePasswordRequest;
use App\Models\User;

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
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('frontend.user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('frontend.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $id)
    {
        try {
            $user = User::findOrFail($id);
            $user->update($request->only('name', 'email', 'address', 'phone', 'birthday', 'gender'));
            return redirect()->back()->with('status', 'Update successful');
        } catch (\Exception $e) {
            
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
        $user = User::findOrFail($id);
        $user->orders()->delete();
        $user->comments()->delete();
        $user->delete();
        return redirect()->back()->with('status', 'Delete successful');
    }

    // Change password
    public function showPasswordForm($id)
    {
        $user = User::findOrFail($id);
        return view('frontend.user.password', compact('user'));
    }
    public function changePassword(ChangePasswordRequest $request, $id)
    {
        try {
            $user = User::findOrFail($id);
            $user->password = Hash::make($request['password']);
            $user->save();
            return redirect()->back()->with('status', 'Password has been changed');
        } catch (\Exception $e) {
            
        }
    }
}
