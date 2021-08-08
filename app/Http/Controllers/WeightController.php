<?php

namespace App\Http\Controllers;

use App\Models\Weight;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WeightController extends Controller
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

            'kg' => 'required'
        ]);

        Weight::create([
            'user_id' => $request->user_id,
            'kg' => $request->cm
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Weight  $weight
     * @return \Illuminate\Http\Response
     */
    public function show(request $request ,$id)
    {
        $weight = weight::all()->where('user_id',$request->user_id);

        return  response()->json(['weight' => $weight,],200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Weight  $weight
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $weight = Weight::find($id);
        if($weight){
            return response()->json(['weight' => $weight,],200);
        }else{
            return response()->json(['error' => "record not found",],404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Weight  $weight
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $weight = Weight::findOrFail($id);

        $weight->update([
            'kg' => $request->cm
        ]);

        return response()->json(['sucess' => "record updated"], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Weight  $weight
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $weight = Weight::find($id);
        $weight->delete();
        return response()->json(['sucess' => "record deleted"], 200);
    }
}
