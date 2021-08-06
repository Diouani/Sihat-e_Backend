<?php

namespace App\Http\Controllers;

use App\Models\Height;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HeightController extends Controller
{
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
    public function store(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required',
            'cm' => 'required'
        ]);

        Height::create([
            'user_id' => $request->user_id,
            'cm' => $request->cm
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Height  $height
     * @return \Illuminate\Http\Response
     */
    public function show(Height $height)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Height  $height
     * @return \Illuminate\Http\Response
     */
    public function edit(Height $height)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Height  $height
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Height $height)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Height  $height
     * @return \Illuminate\Http\Response
     */
    public function destroy(Height $height)
    {
        //
    }
}
