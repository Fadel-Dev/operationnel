<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model




{

    protected $fillable = [
        'nom',
        'semaineAttribuees',
        'trakeurId',
    ];

    public function trackeur()
    {
        return $this->belongsTo(User::class, 'trakeurId');
    }
    use HasFactory;

}
