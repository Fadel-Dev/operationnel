<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Authcontroller;
use App\Http\Controllers\Api\TrackerController;
use App\Http\Controllers\Api\groupeController;
use App\Http\Controllers\Api\moduleController;

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
// List Users
Route::get('auth/listUsers', [Authcontroller::class, 'ListUsers'])->middleware('auth:sanctum');

// FOR TACKER CREATIONG GROUPE

Route::post('auth/createGroupe', [TrackerController::class, 'createGroupe'])->middleware('auth:sanctum');


// RECUP ALL GROUPES
Route::get('auth/listGroupes', [groupeController::class, 'listGroupes'])->middleware('auth:sanctum');

// CREATE MODULES
Route::post('auth/createModule', [moduleController::class, 'createModule'])->middleware('auth:sanctum');
