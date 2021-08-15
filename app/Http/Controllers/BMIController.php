<?php

namespace App\Http\Controllers;

use App\Models\BMI;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BMIController extends Controller
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
            'bmi' => 'required'

        ]);


        if($validator->fails()){
           return response()->json([
        $validator->errors()],500);

           }

        $user_id = auth()->user()->id;
       $create =  BMI::create([
            'user_id' => $user_id,
            'bmi' => $request->bmi,
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
     * @param  \App\Models\BMI  $BMI
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $user_id = auth()->user()->id;



        $last_BMI = BMI::where("user_id", $user_id)->latest()->first();


        if($last_BMI){
        $historique = BMI::select("*")

        ->where('id', '!=', $last_BMI->id)

        ->where("user_id", $user_id)

        ->orderBy('id', 'desc')

        ->get();
        }

if($last_BMI){
    if($historique){
        return  response()->json(['last_BMI' => $last_BMI,'historique' => $historique],200);
    }
    return  response()->json(['last_BMI' => $last_BMI,'historique' => "Aucun historique"],200);   // normalement
}else {
    return "Hello";
}

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BMI  $BMI
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $BMI = BMI::find($id);
if($BMI){
    return response()->json(['BMI' => $BMI,],200);
}else{
    return response()->json(['error' => "record not found",],404);
}

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BMI  $BMI
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $BMI = BMI::findOrFail($id);

        $BMI->update([
            'bmi' => $request->bmi
        ]);


return response()->json(['sucess' => "record updated"], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BMI  $BMI
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $BMI = BMI::find($id);
        $BMI->delete();
        return response()->json(['sucess' => "record deleted"], 200);
    }
}
