<?php

namespace App\Models;

use App\Models\Groupe;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    use HasFactory, Notifiable;
        use HasApiTokens, HasFactory, Notifiable;


 public function groupes()
    {
        return $this->hasMany(Groupe::class, 'tuteurId');
    }

    public function modules() {
        return $this->hasMany(Groupe::class, 'trackeurId');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected  $fillable = [ 'prenom', 'nom', 'role', 'adresse', 'sexe', 'telephone', 'email', 'password', 'heureEffectuee', 'heureNonEffectue' ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
