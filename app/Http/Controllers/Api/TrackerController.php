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
public function createGroupe(Request $request)
{
    $tracker = Auth::user();
    $trackerId = $tracker->id;
    $addingGroupe = Validator::make($request->all(), [
        'nom' => 'required',
        'moduleId' => 'required',
        'tuteurId' => 'required',
        'heureAEffectue' => 'required',
    ]);
    if ($addingGroupe->fails()) {
        return response()->json([
            'status' => false,
            'message' => 'Validation error',
            'errors' => $addingGroupe->errors()
        ], 400);
    }

    if ( $tracker->role !== 'tuteur' && $tracker->role !== 'etudiant') {
        // Create a new Groupe
        $tracker->groupes()->create([
            'nom' => $request->nom,
            'moduleId' => $request->moduleId,
            'tuteurId' => $request->tuteurId,
            'heureAEffectue' => $request->heureAEffectue,

        ]);
        $tutorId = $request->query('tuteurId');
        $base = User::find($tutorId);

        $nomTuteur = $base->nom;
        $prenomTuteur = $base->prenom;
        $emailTuteur = $base->email;
        $role = $base->role;
        return response()->json([
            'status' => true,
            'message' => 'Groupe créé avec succès',
            'id' => $tutorId,
            'nomTuteur' => $nomTuteur,
            'prenomTuteur' => $prenomTuteur,
            'emailTuteur' => $emailTuteur,
            'role' =>'tracker',
            'heureAEffectue' => $request->heureAEffectue,
        ], 201); // 201 for created successfully
    } else {
        // Unauthorized response if the user is not a tracker
        return response()->json([
            'status' => false,
            'message' => 'Vous n\'êtes pas autorisé à créer un groupe',
        ], 403); // 403 for forbidden access
    }
}


// MODIFICATION GROUPE
public function updateGroupe(Request $request, $id)
{
    $tracker = Auth::user();
    $trackerId = $tracker->id;
    $groupe = Groupe::find($id);
    if ($tracker->role !== 'tuteur' && $tracker->role !== 'etudiant') {
        if ($groupe->tuteurId === $trackerId) {
            $groupe->update([
                'nom' => $request->nom,
                'moduleId' => $request->moduleId,
                'tuteurId' => $request->tuteurId,
            ]);
            return response()->json([
                'status' => true,
                'message' => 'Groupe mis à jour avec succès'], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Vous n\'avez pas le droit de modifier ce groupe',
            ], 403);
        }
    } else {
        return response()->json([
            'status' => false,
            'message' => 'Vous n\'avez pas le droit de modifier ce groupe',
        ], 403);
    }
}// 403 for forbidden access

    // DELETE GROUPE
    public function deleteGroupe($id)
    {
        $tracker = Auth::user();
        $trackerId = $tracker->id;
        $groupe = Groupe::find($id);
        if ($tracker->role !== 'tuteur'&& $tracker->role !== 'etudiant') {
            if ($groupe->tuteurId === $trackerId) {
                $groupe->delete();
                return response()->json([
                    'status' => true,
                    'message' => 'Groupe supprimé avec succès'], 200);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Vous n\'avez pas le droit de supprimer ce groupe',
                ], 403);
            }
        } else {
            return response()->json([
                'status' => false,
            ]);}

}


// HEURE EFFECTUEES

// ADD TWO HOURS TO THE TUTOR WHEN HE TAKES A LESSON
// public function addHour($id)
// {
    // $tutor = User::find($id);
    // $tutor->update([
    //     'heureEffectuees' => $tutor->heureEffectuees + 2
    // ]);
    // return response()->json([
    //     'status' => true,
    //     'message' => 'Heure ajoute avec succès'], 200);
    // }


    //  $tracker = Auth::user();
    // $trackerId = $tracker->id;
    // $groupe = Groupe::find($id);
    // if ($tracker->role !== 'tuteur' && $tracker->role !== 'etudiant') {
    //     if ($groupe->tuteurId === $trackerId) {
    //         $groupe->update([
    //             'nom' => $request->nom,
    //             'moduleId' => $request->moduleId,
    //             'tuteurId' => $request->tuteurId,
    //         ]);
    //         return response()->json([
    //             'status' => true,
    //             'message' => 'Groupe mis à jour avec succès'], 200);
    //     } else {
    //         return response()->json([
    //             'status' => false,
    //             'message' => 'Vous n\'avez pas le droit de modifier ce groupe',
    //         ], 403);
    //     }
    // } else {
    //     return response()->json([
    //         'status' => false,
    //         'message' => 'Vous n\'avez pas le droit de modifier ce groupe',
    //     ], 403);
    // }





}
