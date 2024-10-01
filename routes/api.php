<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Authcontroller;
use App\Http\Controllers\Api\TrackerController;
use App\Http\Controllers\Api\groupeController;
use App\Http\Controllers\Api\moduleController;
use App\Http\Controllers\Api\SequenceController;

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

Route::post('createGroupe', [TrackerController::class, 'createGroupe'])->middleware('auth:sanctum');

// MODIFICATION GROUPE
Route::put('modGroupes/{id}',[TrackerController::class, 'updateGroupe'])->middleware('auth:sanctum');
// DELETE GROUPE
Route::delete('deleteGroupes/{id}',[TrackerController::class, 'deleteGroupe'])->middleware('auth:sanctum');

// RECUP ALL GROUPES
Route::get('listGroupes', [groupeController::class, 'listGroupes'])->middleware('auth:sanctum');

// CREATE MODULES
Route::post('createModule', [moduleController::class, 'createModule'])->middleware('auth:sanctum');

// RECUP ALL MODULES
Route::get('listModules', [moduleController::class, 'listModules'])->middleware('auth:sanctum');

// UPDATE MODULE
Route::put('modModules/{id}',[moduleController::class, 'updateModule'])->middleware('auth:sanctum');

// DELETE MODULE

Route::delete('deleteModules/{id}',[moduleController::class, 'deleteModule'])->middleware('auth:sanctum');

// CREATION SEQUENCE
Route::post('createSequence', [SequenceController::class, 'createSequence'])->middleware('auth:sanctum');


// MODIFICATION SEQUENCE
Route::put('modSequence/{id}',[SequenceController::class, 'updateSequence'])->middleware('auth:sanctum');

// DELETE SEQUENCE
Route::delete('deleteSequence/{id}',[SequenceController::class, 'deleteSequence'])->middleware('auth:sanctum');

// RECUP ALL SEQUENCE
Route::get('listSequence', [SequenceController::class, 'listSequence'])->middleware('auth:sanctum');
