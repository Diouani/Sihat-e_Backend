<?php

namespace App\Http\Controllers;

use App\Models\blood_pressure;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BloodPressureController extends Controller
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
        $validator = Validator::make($request->all(), [
            'blood_pressure' => 'required'

        ]);


        if($validator->fails()){
           return response()->json([
        $validator->errors()],500);

           }

        $user_id = auth()->user()->id;
       $create =  blood_pressure::create([
            'user_id' => $user_id,
            'blood_pressure' => $request->blood_pressure,
            'date' => $request->date
        ]);

        if($create){
            return  response()->json(['data' => $create],200);
        }else {
            return  response()->json(['error' => "something went wrong "],404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\blood_pressure  $blood_pressure
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $user_id = auth()->user()->id;



        $last_blood_pressure = blood_pressure::where("user_id", $user_id)->latest()->first();


        if($last_blood_pressure){
        $historique = blood_pressure::select("*")

        ->where('id', '!=', $last_blood_pressure->id)

        ->where("user_id", $user_id)

        ->orderBy('id', 'desc')

        ->get();
        }

if($last_blood_pressure){
    if($historique){
        return  response()->json(['last_blood_pressure' => $last_blood_pressure,'historique' => $historique],200);
    }
    return  response()->json(['last_blood_pressure' => $last_blood_pressure,'historique' => "Aucun historique"],200);   // normalement
}else {
    return "Hello";
}

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\blood_pressure  $blood_pressure
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blood_pressure = blood_pressure::find($id);
if($blood_pressure){
    return response()->json(['blood_pressure' => $blood_pressure,],200);
}else{
    return response()->json(['error' => "record not found",],404);
}

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\blood_pressure  $blood_pressure
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $blood_pressure = blood_pressure::findOrFail($id);

        $blood_pressure->update([
            'blood_pressure' => $request->blood_pressure
        ]);


return response()->json(['sucess' => "record updated"], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\blood_pressure  $blood_pressure
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blood_pressure = blood_pressure::find($id);
        $blood_pressure->delete();
        return response()->json(['sucess' => "record deleted"], 200);
    }
}
