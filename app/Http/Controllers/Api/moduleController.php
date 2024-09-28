<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Groupe;
use App\Models\Module;
// use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;


class moduleController extends Controller
{
    public function createModule(Request $request)
    {
    $tracker = Auth::user();
        $addingModule = Validator::make($request->all(), [
            'nom' => 'required|string|max:255',
            'semaineAttribuees' => 'required|integer',
            'trackeurId' => 'required',
        ]);

        if ($addingModule->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $addingModule->errors()
            ], 400);
        }

        // Check if the user has the 'trackeur' role
        if ( $tracker->role !== 'tuteur' && $tracker->role !== 'admin') {

            $tracker->modules()->create([
                'nom' => $request->nom,
                'trackeurId' => $request->trackeurId,
                'semaineAttribuees' => $request->semaineAttribuees,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Module created successfully',
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Vous n etes pas autoriser a cree ce module module',
            ], 401);
        }
    }

}
