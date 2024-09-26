<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sequences extends Model
{
     protected $fillable = [
        'groupeId', 'moduleId', 'tuteurId', 'etat', 'nom',
    ];

    // Relations avec les modèles
    public function groupe()
    {
        return $this->belongsTo(Groupe::class, 'groupeId');
    }

    public function module()
    {
        return $this->belongsTo(Module::class, 'moduleId');
    }

    public function tuteur()
    {
        return $this->belongsTo(User::class, 'tuteurId');
    }
    use HasFactory;
}
