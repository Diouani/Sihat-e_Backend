<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Patient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


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

        $user_id = [ "user_id" => auth()->user()->id];
        $validator = Validator::make($user_id, [
            "user_id" => 'unique:patients',

        ]);




            if($validator->fails()){
                return response()->json([
             $validator->errors(),409
                ]);

    }else{
     // User::find()
     $user_id = auth()->user()->id;

     Patient::create([
        'user_id' => $user_id,
        'first_name'=> $request->first_name,
        'last_name'=> $request->last_name,
        'birth_day'=> $request->birth_day,
        'bio_sex'=> $request->bio_sex,
        'phone'=> $request->phone,
        'adress'=> $request->adress,
        'city'=> $request->citys
        ]
     );
     return  response()->json(['data' => "created" ],200);
    }







    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient)
    {
        //


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $patient = Patient::join('users', 'users.id', '=', 'patients.user_id')->where('user_id',auth()->user()->id)->get(['patients.*', 'users.email']);

        

        if($patient){
            return  response()->json(['data' => $patient],200);
        }else {
            return  response()->json(['error' => "Patient Not Found"],404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $user_id = auth()->user()->id;
        Patient::where('user_id',$user_id)->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patient $patient)
    {

    }
}
