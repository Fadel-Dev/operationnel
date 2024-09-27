<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Groupe extends Model
{
    use HasFactory;


    protected $fillable = ['nom', 'moduleId', 'tuteurId'];

    // Relation avec Module
    public function module()
    {
        return $this->belongsTo(Module::class, 'moduleId');
    }

    // Relation avec Tuteur (User)
    public function tuteur()
    {
        return $this->belongsTo(User::class, 'tuteurId');
    }
}
