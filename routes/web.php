<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/users', function () {
    return view('home');
});

Route::get('/users/show',[UserController::class, 'showUsers']);

Route::get('/users/create',[UserController::class,'loadCreateView']);

Route::post('/users/submit',[UserController::class,'submitDetail']);

Route::post('/users/delete',[UserController::class,'deleteUser']);

Route::post('/users/editUser',[UserController::class,'editUser']);