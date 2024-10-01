<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Groupe;

class groupeController extends Controller
{
    // RECUP ALL GROUPES
    public function listGroupes()
    {
        return Groupe::all();
    }



}
