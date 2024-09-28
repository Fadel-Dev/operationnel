<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Groupe;
use App\Models\Module;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;


class TrackerController extends Controller
{
//     public function __construct(){
//     $this->middleware('auth:api');
// }

public function createGroupe(Request $request)
{
    $tracker = Auth::user();

    $trackerId = $tracker->id;

    // Validate the request
    $addingGroupe = Validator::make($request->all(), [
        'nom' => 'required',
        'moduleId' => 'required',
        'tuteurId' => 'required',
    ]);


    if ($addingGroupe->fails()) {
        return response()->json([
            'status' => false,
            'message' => 'Validation error',
            'errors' => $addingGroupe->errors()
        ], 400);
    }



    if ( $tracker->role !== 'tuteur' && $tracker->role !== 'admin') {
        // Create a new Groupe
        $tracker->groupes()->create([
            'nom' => $request->nom,
            'moduleId' => $request->moduleId,
            'tuteurId' => $request->tuteurId,
        ]);


        return response()->json([
            'status' => true,
            'message' => 'Groupe créé avec succès'
        ], 201); // 201 for created successfully
    } else {
        // Unauthorized response if the user is not a tracker
        return response()->json([
            'status' => false,
            'message' => 'Vous n\'êtes pas autorisé à créer un groupe',

        ], 403); // 403 for forbidden access
    }
}



}
