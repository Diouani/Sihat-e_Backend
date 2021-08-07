<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\data\Symptoms;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class SymptomsController extends Controller
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
    public function create($symptom_name)
    {
        $result = Symptoms::where('symptom_name', 'like', '%'.$symptom_name.'%')->get();
        if(count($result)){
            return response()->json(['result',$result],200);
        } else {
            return response()->json(['Result', 'No records found'],404);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:symptoms',
        ]);
if($validator->fails()){
    return response()->json([
     'message'=>'Symptom already exist'
        ],409);

}else{
    Symptoms::create([
        'name'=> $request->name
    ]);

    return response()->json(['message' => 'Succes'],200);
}

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\data\Symptoms  $symptoms
     * @return \Illuminate\Http\Response
     */
    public function show(Symptoms $symptoms)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\data\Symptoms  $symptoms
     * @return \Illuminate\Http\Response
     */
    public function edit(Symptoms $symptoms)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\data\Symptoms  $symptoms
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Symptoms $symptoms)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\data\Symptoms  $symptoms
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $symptom = Symptoms::find($id);
        $symptom->delete();
        return response()->json(['sucess' => "record deleted"], 200);
    }
}
