<?php

namespace App\Http\Controllers\User;

use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Contracts\CommentRepositoryInterface;
use App\Http\Requests\Comment\CommentStoreRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class CommentController extends Controller
{
    protected $commentRepository;
    protected $userRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        CommentRepositoryInterface $commentRepository, UserRepositoryInterface $userRepository
    ) {
        $this->commentRepository = $commentRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(CommentStoreRequest $request)
    {
        try {
            $user = $this->userRepository->findOrFail(Auth::user()->id);
            $user->comments()->create($request->only('content', 'product_id'));
            
            return back();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
