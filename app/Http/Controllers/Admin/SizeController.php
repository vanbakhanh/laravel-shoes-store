<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Size\SizeStoreRequest;
use App\Http\Requests\Size\SizeUpdateRequest;
use App\Models\Size;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sizes = Size::all();
        return view('backend.size.index', compact('sizes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sizes = Size::all();
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
        try {
            Size::create($request->only('name'));
            return redirect()->back()->with('status', 'Create successful');
        } catch (\Exception $e) {
            
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
        $size = Size::findOrFail($id);
        return view('backend.size.show', compact('size'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $size = Size::findOrFail($id);
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
        try {
            Size::findOrFail($id)->update($request->only('name'));
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
        try {
            Size::findOrFail($id)->delete();
            return redirect()->back()->with('delete', 'Delete successful');
        } catch (\Exception $e) {
            
        }
    }
}
