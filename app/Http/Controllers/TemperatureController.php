<?php

namespace App\Http\Controllers;

use App\Models\Temperature;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TemperatureController extends Controller
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
            'temperature' => 'required'

        ]);


        if($validator->fails()){
           return response()->json([
        $validator->errors()],500);

           }

        $user_id = auth()->user()->id;
       $create =  Temperature::create([
            'user_id' => $user_id,
            'temperature' => $request->temperature,
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
     * @param  \App\Models\Temperature  $Temperature
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $user_id = auth()->user()->id;



        $last_temperature = Temperature::where("user_id", $user_id)->latest()->first();


        if($last_temperature){
        $historique = Temperature::select("*")

        ->where('id', '!=', $last_temperature->id)

        ->where("user_id", $user_id)

        ->orderBy('id', 'desc')

        ->get();
        }
if($last_temperature){
    if($historique){
        return  response()->json(['last_Temperature' => $last_temperature,'historique' => $historique],200);
    }
    return  response()->json(['last_Temperature' => $last_temperature,'historique' => "Aucun historique"],200);   // normalement
}else {
    return "Hello";
}

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Temperature  $Temperature
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $temperature = Temperature::find($id);
if($temperature){
    return response()->json(['Temperature' => $temperature,],200);
}else{
    return response()->json(['error' => "record not found",],404);
}

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Temperature  $Temperature
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $temperature = Temperature::findOrFail($id);

        $temperature->update([
            'temperature' => $request->temperature
        ]);


return response()->json(['sucess' => "record updated"], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Temperature  $Temperature
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $temperature = Temperature::find($id);
        $temperature->delete();
        return response()->json(['sucess' => "record deleted"], 200);
    }
}
