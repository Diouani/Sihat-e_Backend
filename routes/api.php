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
Route::resource('height', HeightController::class);

Route::middleware('auth:api')->group(function () {

    Route::get('details', [PassportController::class, 'details']);
    Route::get('logout', [PassportController::class, 'logout']);
    // Route::resource('patient', PatientController::class);
    Route::get('patient/fetch',[PatientController::class , 'edit']);



});








Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
