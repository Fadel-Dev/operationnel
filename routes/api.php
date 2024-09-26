<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Authcontroller;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


// FOR STUDENT
Route::post('auth/register', [Authcontroller::class, 'Register']);

 Route::post('auth/login', [Authcontroller::class, 'Login']);

//  Register for Tutore
Route::post('auth/registerTutore', [Authcontroller::class, 'RegisterTutore']);
// Register for Tracker
Route::post('auth/registerTracker', [Authcontroller::class, 'RegisterTracker']);

Route::get('list',[Authcontroller::class,'ListUsers']);
