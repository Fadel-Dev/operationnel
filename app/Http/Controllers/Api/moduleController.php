<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use App\Models\Groupe;
use App\Models\Module;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;


class moduleController extends Controller
{

    public function createModule(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string|max:255',
            'semaineAttribuees' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors(),
            ], 400);
        }

          $tracker = Auth::user();

         $trackerId = $tracker->id;

        if ( $tracker->role !== 'tuteur' && $tracker->role !== 'admin')
        {
            $module = Module::create([
                'nom' => $request->nom,
                'trakeurId' => $trackerId,
                'semaineAttribuees' => $request->semaineAttribuees,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Module created successfully',
                'module' => $module,
            ], 201);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Vous n\'etes pas autoris  cree ce module',
            ], 403);
        }
    }

    public function listModules()
    {
        return Module::all();
    }

      public function updateModule(Request $request, $id)
    {
        $trackeur = Auth::user();
        $trackeurId = $trackeur->id;
        $module = Module::find($id);




        if ($trackeur->role !== 'tuteur' && $trackeur->role !== 'admin')
        {
            if ($module->trakeurId === $trackeurId) {
                $module->update([
                    'nom' => $request->nom,
                    'trakeurId' => $trackeurId,
                    'semaineAttribuees' => $request->semaineAttribuees,
                ]);
                return response()->json([
                    'status' => true,
                    'message' => 'Module mis à jour avec succès'], 200);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Vous n\'avez pas le droit de modifier ce module',
                ], 403);
            }
        } else
        {
            return response()->json([
                'status' => false,
                'message' => 'Vous n\'avez pas le droit de modifier ce module',
            ], 403);
        }

    }

    public function deleteModule($id)
    {
        $trackeur = Auth::user();
        $trackeurId = $trackeur->id;
        $module = Module::find($id);
        if ($trackeur->role !== 'tuteur' && $trackeur->role !== 'admin')
        {
            if ($module->trakeurId === $trackeurId) {
                $module->delete();
                return response()->json([
                    'status' => true,
                    'message' => 'Module supprimé avec succès'], 200);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Vous n\'avez pas le droit de supprimer ce module',
                ], 403);
            }
        } else
        {
            return response()->json([
                'status' => false,
            ]);
        }
    }

}
