<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Color\ColorStoreRequest;
use App\Http\Requests\Color\ColorUpdateRequest;
use App\Repositories\Contracts\ColorRepositoryInterface;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    protected $colorRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ColorRepositoryInterface $colorRepository)
    {
        $this->colorRepository = $colorRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $colors = $this->colorRepository->all();

        return view('backend.color.index', compact('colors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $colors = $this->colorRepository->all();

        return view('backend.color.create', compact('colors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ColorStoreRequest $request)
    {
        try {
            $this->colorRepository->createColor($request);

            return back()->with('status', trans('messages.created_success'));
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
        $color = $this->colorRepository->findOrFail($id);

        return view('backend.color.edit', compact('color'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ColorUpdateRequest $request, $id)
    {
        try {
            $this->colorRepository->updateColor($request, $id);

            return back()->with('status', trans('messages.updated_success'));
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
            $this->colorRepository->findOrFail($id)->delete();

            return back()->with('delete', trans('messages.deleted_success'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
