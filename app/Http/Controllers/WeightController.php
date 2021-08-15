<?php

namespace App\Http\Controllers;

use App\Models\Weight;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
        $validator = Validator::make($request->all(), [
            'kg' => 'required'

        ]);


        if($validator->fails()){
           return response()->json([
        $validator->errors()],500);

           }

        $user_id = auth()->user()->id;
       $create =  Weight::create([
            'user_id' => $user_id,
            'kg' => $request->kg,
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
     * @param  \App\Models\Weight  $Weight
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $user_id = auth()->user()->id;



        $last_weight = Weight::where("user_id", $user_id)->latest()->first();


if($last_weight){
    $historique = Weight::select("*")

    ->where('id', '!=', $last_weight->id)

    ->where("user_id", $user_id)

    ->orderBy('id', 'desc')

    ->get();
}


if($last_weight){
    if($historique){
        return  response()->json(['last_weight' => $last_weight,'historique' => $historique],200);
    }
    return  response()->json(['last_weight' => $last_weight,'historique' => "Aucun historique"],200);   // normalement
}else {
    return "no record found";
}

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Weight  $Weight
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Weight = Weight::find($id);
if($Weight){
    return response()->json(['weight' => $Weight,],200);
}else{
    return response()->json(['error' => "record not found",],404);
}

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Weight  $Weight
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $Weight = Weight::findOrFail($id);

        $Weight->update([
            'kg' => $request->kg
        ]);


return response()->json(['sucess' => "record updated"], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Weight  $Weight
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Weight = Weight::find($id);
        $Weight->delete();
        return response()->json(['sucess' => "record deleted"], 200);
    }
}
