<?php

namespace App\Http\Controllers\User;

use App\Repositories\Contracts\UserRepositoryInterface;
use App\Http\Requests\User\UserUpdateRequest;
use App\Http\Requests\User\ChangePasswordRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Auth;

class UserController extends Controller
{
    protected $userRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->userRepository->all();

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
            $user = $this->userRepository->findOrFail(Auth::user()->id);

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
            $this->userRepository->update(Auth::user()->id, $request->only(
                'name', 'email', 'address', 'phone', 'birthday', 'gender'
            ));

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
            $user = $this->userRepository->findOrFail($id);
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
            $user = $this->userRepository->findOrFail(Auth::user()->id);

            return view('frontend.user.password', compact('user'));
        }
        return redirect()->back();
    }
    
    public function changePassword(ChangePasswordRequest $request)
    {
        try {
            $user = $this->userRepository->findOrFail(Auth::user()->id);
            $user->password = Hash::make($request['password']);
            $user->save();

            return back()->with('status', 'Password has been changed');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
