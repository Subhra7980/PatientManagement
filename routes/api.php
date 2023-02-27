<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\Auth\UserController;

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
Route::post('/otp-send'     , [LoginController::class, 'otpSend']);
Route::post('/otp-verify'   , [LoginController::class, 'otpVerify']);

Route::group(['middleware' => ['auth:sanctum']], function (){
    #PATIENT API
        Route::post('/save-patient-data'           , [PatientController::class, 'savePatient']);
        Route::get('/get-patients-list'            , [PatientController::class, 'getPatientList']);
        Route::get('/get-patient-by-id/{patId}'    , [PatientController::class, 'getPatientById']);
        Route::post('/update-patient-data/{patId}' , [PatientController::class, 'updatePatient']);
        Route::post('/delete-patients/{patId}'     , [PatientController::class, 'deletePatient']);
        Route::get('/get-patients-count'           , [PatientController::class, 'getPatientCount']);
    #USER API
        Route::post('/save-user-data'              , [UserController::class, 'saveUser']);
        Route::get('/view-all-user-data'           , [UserController::class, 'getUserList']);
        Route::get('/get-user-by-id/{userId}'      , [UserController::class, 'getUserById']);
        Route::post('/update-user-data/{userId}'   , [UserController::class, 'updateUser']);
        Route::post('/delete-user/{userId}'        , [UserController::class, 'deleteUser']);
        Route::get('/get-users-count'              , [UserController::class, 'getUsersCount']);
    #LOGOUT API   
        Route::post('/logout'                  , [LoginController::class  , 'logout']); 
});
