<?php

namespace App\Http\Controllers\Frontend;

use App\Repositories\Contracts\UserRepositoryInterface;
use App\Http\Requests\User\UserUpdateRequest;
use App\Http\Requests\User\ChangePasswordRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::check() && Auth::user()->id == $id) {
            $user = $this->userRepository->findOrFail($id);

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
    public function update(UserUpdateRequest $request, $id)
    {
        try {
            $this->userRepository->update($request, $id);

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
            $this->userRepository->destroy($id);

            return back()->with('status', 'Delete successful');
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Show password form.
     */
    public function showPasswordForm($id)
    {
        if (Auth::check() && Auth::user()->id == $id) {
            $user = $this->userRepository->findOrFail($id);

            return view('frontend.user.password', compact('user'));
        }
        return redirect()->back();
    }
    
    /**
     * Change password.
     */
    public function changePassword(ChangePasswordRequest $request, $id)
    {
        try {
            $this->userRepository->changePassword($request, $id);

            return back()->with('status', 'Password has been changed');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Verify user when click the link sent via email.
     */
    protected function verify($token)
    {
        try {
            $user = $this->userRepository->verifyUser($token);

            return redirect()->route('login')
            ->with('status', trans('auth.verified_email'))
            ->withInput($user->only('email'));
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
