<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SystemController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/login'                   ,[SystemController::class  ,'login']);
Route::get('/verify'                  ,[SystemController::class  ,'login']);
Route::get('/'                        ,[SystemController::class  ,'dashboard']);
Route::get('/all-patients'            ,[SystemController::class  ,'dashboard']);
Route::get('/add-patient'             ,[SystemController::class  ,'dashboard']);
Route::get('/edit-patient/{patId}'    ,[SystemController::class  ,'dashboard']);
Route::get('/add-user'                ,[SystemController::class  ,'dashboard']);
Route::get('/view-user'               ,[SystemController::class  ,'dashboard']);
Route::get('/edit-user/{userId}'      ,[SystemController::class  ,'dashboard']);

Route::get('/all-doctors'             ,[SystemController::class  ,'dashboard']);
Route::get('/add-doctor'              ,[SystemController::class  ,'dashboard']);
Route::get('/edit-doctor/{doctorId}'  ,[SystemController::class  ,'dashboard']);