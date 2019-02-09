<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Size\SizeStoreRequest;
use App\Http\Requests\Size\SizeUpdateRequest;
use App\Repositories\Contracts\SizeRepositoryInterface;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    protected $sizeRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(SizeRepositoryInterface $sizeRepository)
    {
        $this->sizeRepository = $sizeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sizes = $this->sizeRepository->all();

        return view('backend.size.index', compact('sizes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sizes = $this->sizeRepository->all();

        return view('backend.size.create', compact('sizes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SizeStoreRequest $request)
    {
        $size = $request->only('name');
        $this->sizeRepository->createSize($size);

        return back()->with('status', trans('messages.created_success'));
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
        $size = $this->sizeRepository->findOrFail($id);

        return view('backend.size.edit', compact('size'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SizeUpdateRequest $request, $id)
    {
        $size = $request->only('name');
        $this->sizeRepository->updateSize($size, $id);

        return back()->with('status', trans('messages.updated_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->sizeRepository->findOrFail($id)->delete();

        return back()->with('status', trans('messages.deleted_success'));
    }
}
