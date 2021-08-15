<?php

namespace App\Http\Controllers;

use App\Models\Glucose;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class GlucoseController extends Controller
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
            'mg' => 'required'

        ]);


        if($validator->fails()){
           return response()->json([
        $validator->errors()],500);

           }

        $user_id = auth()->user()->id;
       $create =  Glucose::create([
            'user_id' => $user_id,
            'mg' => $request->mg,
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
     * @param  \App\Models\Glucose  $Glucose
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $user_id = auth()->user()->id;



        $last_glucose = Glucose::where("user_id", $user_id)->latest()->first();


        if($last_glucose){
        $historique = Glucose::select("*")

        ->where('id', '!=', $last_glucose->id)

        ->where("user_id", $user_id)

        ->orderBy('id', 'desc')

        ->get();
        }

if($last_glucose){
    if($historique){
        return  response()->json(['last_Glucose' => $last_glucose,'historique' => $historique],200);
    }
    return  response()->json(['last_Glucose' => $last_glucose,'historique' => "Aucun historique"],200);   // normalement
}else {
    return "no record found";
}

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Glucose  $Glucose
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $glucose = Glucose::find($id);
if($glucose){
    return response()->json(['Glucose' => $glucose,],200);
}else{
    return response()->json(['error' => "record not found",],404);
}

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Glucose  $Glucose
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $Glucose = Glucose::findOrFail($id);

        $Glucose->update([
            'mg' => $request->mg
        ]);


return response()->json(['sucess' => "record updated"], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Glucose  $Glucose
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $glucose = Glucose::find($id);
        $glucose->delete();
        return response()->json(['sucess' => "record deleted"], 200);
    }
}
