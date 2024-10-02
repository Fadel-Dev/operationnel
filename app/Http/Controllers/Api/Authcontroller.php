<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;



class Authcontroller extends Controller
{

    public function Register(Request $request)
     {
        try {
            //Validated
            $validateUser = Validator::make($request->all(),
            [
                'nom' => 'required',
                'prenom' => 'required',
                'role' => 'required',
                'adresse' => 'required',
                'sexe' => 'required',
                'telephone' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required',
                'heureEffectuee' => 'nullable',
                'heureNonEffectue' => 'nullable',

            ]);

            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            $user = User::create([
                'nom' => $request->nom,
                'prenom' => $request->prenom,
                'role' => $request->role,
                'adresse' => $request->adresse,
                'sexe' => $request->sexe,
                'telephone' => $request->telephone,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'heureEffectuee' => $request->heureEffectuee,
                'heureNonEffectue' => $request->heureNonEffectue,

            ]);

            return response()->json([
                'status' => true,
                'message' => 'User Created Successfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

     //  REGISTER FOR TUTOR
      public function RegisterTutore(Request $request)
     {
        try {
            //Validated
            $validateUser = Validator::make($request->all(),
            [
                'nom' => 'required',
                'prenom' => 'required',
                'adresse' => 'required',
                'sexe' => 'required',
                'telephone' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required',
                'heureEffectuee' => 'nullable',
                'heureNonEffectue' => 'nullable',

            ]);

            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            $user = User::create([
                'nom' => $request->nom,
                'prenom' => $request->prenom,
                'role' => "tuteur",
                'adresse' => $request->adresse,
                'sexe' => $request->sexe,
                'telephone' => $request->telephone,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'heureEffectuee' => $request->heureEffectuee,
                'heureNonEffectue' => $request->heureNonEffectue,

            ]);

            return response()->json([
                'status' => true,
                'message' => 'User Created Successfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken,
                'role'=> $user->role,

            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    //REGISTER FOR TRACKER
      public function RegisterTracker(Request $request)
     {
        try {
            //Validated
            $validateUser = Validator::make($request->all(),
            [
                'nom' => 'required',
                'prenom' => 'required',
                'adresse' => 'required',
                'sexe' => 'required',
                'telephone' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required',
                'heureEffectuee' => 'nullable',
                'heureNonEffectue' => 'nullable',

            ]);

            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            $user = User::create([
                'nom' => $request->nom,
                'prenom' => $request->prenom,
                'role' => "tracker",
                'adresse' => $request->adresse,
                'sexe' => $request->sexe,
                'telephone' => $request->telephone,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'heureEffectuee' => $request->heureEffectuee,
                'heureNonEffectue' => $request->heureNonEffectue,

            ]);

            return response()->json([
                'status' => true,
                'message' => 'User Created Successfully',
                'role'=> $user->role,
                'sexe'=> $user->sexe,
                'email'=> $user->email,
                'telephone'=> $user->telephone,
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }


// REGISTER FOR ADMIN

  public function RegisterAdmin(Request $request)
     {
        try {
            //Validated
            $validateUser = Validator::make($request->all(),
            [
                'nom' => 'required',
                'prenom' => 'required',
                'adresse' => 'required',
                'sexe' => 'required',
                'telephone' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required',
                'heureEffectuee' => 'nullable',
                'heureNonEffectue' => 'nullable',

            ]);

            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            $user = User::create([
                'nom' => $request->nom,
                'prenom' => $request->prenom,
                'role' => "admin",
                'adresse' => $request->adresse,
                'sexe' => $request->sexe,
                'telephone' => $request->telephone,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'heureEffectuee' => $request->heureEffectuee,
                'heureNonEffectue' => $request->heureNonEffectue,

            ]);

            return response()->json([
                'status' => true,
                'message' => 'Admin Created Successfully',
                'role'=> $user->role,
                'sexe'=> $user->sexe,
                'email'=> $user->email,
                'telephone'=> $user->telephone,
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }





    /**
     * Login The User
     * @param Request $request
     * @return User
     */
    public function Login(Request $request)
    {
        try {
            $validateUser = Validator::make($request->all(),
            [
                'email' => 'required|email',
                'password' => 'required'
            ]);

            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            if(!Auth::attempt($request->only(['email', 'password']))){
                return response()->json([
                    'status' => false,
                    'message' => 'Email & Password does not match with our record.',
                ], 401);
            }

            $user = User::where('email', $request->email)->first();

            return response()->json([
                'status' => true,
                'message' => 'User Logged In Successfully',
                'role'=> $user->role,
                'sexe'=> $user->sexe,
                'email'=> $user->email,
                'telephone'=> $user->telephone,
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }



    // RECUPERER ALL THE USERS
    public function ListUsers()
    {
        return User::all();
    }

// DYNAMICS DASHBOARD LOGIN
}
