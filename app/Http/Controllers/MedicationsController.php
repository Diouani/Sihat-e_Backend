<?php

namespace App\Http\Controllers;

use App\Models\Medications;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class MedicationsController extends Controller
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
    public function create($medication_name)
    {
        $result = Medications::where('medication_name', 'like', '%'.$medication_name.'%')->get();
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
        $validator = Validator::make($request->all(), [
            'medication_name' => 'required|unique:medications',
        ]);
if($validator->fails()){
    return response()->json([
     'message'=>'medication already exist'
        ],409);

}else{
    Medications::create([
        'medication_name'=> $request->name
    ]);

    return response()->json(['message' => 'Succes'],200);
}
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Medications  $medications
     * @return \Illuminate\Http\Response
     */
    public function show(Medications $medications)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Medications  $medications
     * @return \Illuminate\Http\Response
     */
    public function edit(Medications $medications)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Medications  $medications
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Medications $medications)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Medications  $medications
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $medication = Medications::find($id);
        $medication->delete();
        return response()->json(['sucess' => "record deleted"], 200);
    }
}
