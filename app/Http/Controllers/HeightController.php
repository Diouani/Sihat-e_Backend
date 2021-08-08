<?php

namespace App\Http\Controllers;

use App\Models\Height;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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

            'cm' => 'required'
        ]);

       $create =  Height::create([
            'user_id' => $request->user_id,
            'cm' => $request->cm
        ]);

        if($create){
            return 1;
        }else {
            return 0;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Height  $height
     * @return \Illuminate\Http\Response
     */
    public function show($request)
    {
        $height = Height::all()->where('user_id',$request->user_id);

        return  response()->json(['height' => $height,],200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Height  $height
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $height = Height::find($id);
if($height){
    return response()->json(['height' => $height,],200);
}else{
    return response()->json(['error' => "record not found",],404);
}

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Height  $height
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $height = Height::findOrFail($id);

        $height->update([
            'cm' => $request->cm
        ]);


return response()->json(['sucess' => "record updated"], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Height  $height
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $height = Height::find($id);
        $height->delete();
        return response()->json(['sucess' => "record deleted"], 200);
    }
}
