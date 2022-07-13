<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StdentController;
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

Route::get('/', function () {
    return view('welcome');
});
Route::get('ajax/getdata',[StdentController::class,'getdata']);
Route::post('add/student',[StdentController::class,'addstudent']);
Route::get('edit/data/{id}',[StdentController::class,'editdata']);
Route::put('update/student/{id}',[StdentController::class,'update']);
Route::delete('delete/data/{id}',[StdentController::class,'delete']);