<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Module;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Sequences;

class SequenceController extends Controller
{
    public function createSequence(Request $request)
    {
        $tracker = Auth::user();
        $trackeurId=$tracker->id;



        $addingSequence = Validator::make($request->all(), [
              'nom' => 'required|string|max:255',
            'groupeId' => 'required|integer',
            'tuteurId' => 'required|integer',
            'moduleId' => 'required|integer',
            'etat' => 'required|string|max:255',
        ]);
        if($addingSequence->fails()){
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $addingSequence->errors()
            ], 400);
        }


        if ( $tracker->role !== 'tuteur' && $tracker->role !== 'admin'){
            $sequence = sequences::create([
            'nom' => $request->nom,
            'groupeId' => $request->groupeId,
            'tuteurId' => $request->tuteurId,
            'moduleId' => $request->moduleId,
            'etat' => $request->etat,
        ]);
        } else
        {
            return response()->json([
                'status' => false,
                'message' => 'Vous n\'avez pas le droit d\'ajouter une sequence',

            ],403);
        }







        return response()->json([
            'status' => true,
            'message' => 'Sequence created successfully',
            'sequence' => $sequence,
            'nomTuteur' => $nomTuteur,
            'prenomTuteur' => $prenomTuteur,
            'emailTuteur' => $emailTuteur
        ], 200);


    }

    public function updateSequence(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string|max:255',
            'groupeId' => 'required|integer',
            'tuteurId' => 'required|integer',
            'moduleId' => 'required|integer',
            'etat' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors(),
            ], 400);
        }

        $sequence = Sequence::find($id);
        $sequence->update([
            'nom' => $request->nom,
            'groupeId' => $request->groupeId,
            'tuteurId' => $request->tuteurId,
            'moduleId' => $request->moduleId,
            'etat' => $request->etat,
        ]);
        return response()->json([
            'status' => true,
            'message' => 'Sequence updated successfully',
            'sequence' => $sequence,
        ], 200);
    }

    public function deleteSequence($id)
    {
        $sequence = Sequence::find($id);
        $sequence->delete();
        return response()->json([
            'status' => true,
            'message' => 'Sequence deleted successfully',
        ], 200);
    }
}
