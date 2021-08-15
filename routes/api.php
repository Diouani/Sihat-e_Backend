<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HeightController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PassportController;
use App\Http\Controllers\NewsletterController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::post('login', [PassportController::class, 'login'])->name('login');

Route::post('register', [PassportController::class, 'register']);

Route::post('newsletter' , [NewsletterController::class ,'store']);


Route::middleware('auth:api')->group(function () {

    Route::get('details', [PassportController::class, 'details']);
    Route::get('logout', [PassportController::class, 'logout']);
    // Route::resource('patient', PatientController::class);

    // Patient Routes
    Route::get('patient/fetch',[PatientController::class , 'edit']);
    Route::post('patient/create',[PatientController::class , 'store']);
    Route::put('patient/update',[PatientController::class , 'update']);


// height controller
    Route::get('height/fetch',[HeightController::class , 'show']);
    Route::post('height/create',[HeightController::class , 'store']);
    Route::get('height/{id}',[HeightController::class , 'edit']);
    Route::put('height/update/{id}',[HeightController::class , 'update']);
    Route::delete('height/delete/{id}',[HeightController::class , 'destroy']);



    // weight controller
    Route::get('weight/fetch',[WeightController::class , 'show']);
    Route::post('weight/create',[WeightController::class , 'store']);
    Route::get('weight/{id}',[WeightController::class , 'edit']);
    Route::put('weight/update/{id}',[WeightController::class , 'update']);
    Route::delete('weight/delete/{id}',[WeightController::class , 'destroy']);

//BMI
    Route::get('BMI/fetch',[BMIController::class , 'show']);
    Route::post('BMI/create',[BMIController::class , 'store']);
    Route::get('BMI/{id}',[BMIController::class , 'edit']);
    Route::put('BMI/update/{id}',[BMIController::class , 'update']);
    Route::delete('BMI/delete/{id}',[BMIController::class , 'destroy']);

});








Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
