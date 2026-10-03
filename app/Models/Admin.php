<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Admin extends Authenticatable
{
    use SoftDeletes;

    protected $table = 'admins';

    protected $fillable = ['nom', 'email', 'mot_de_passe', 'actif'];

    protected $hidden = ['mot_de_passe'];

    protected $casts = [
        'actif' => 'boolean',
        'derniere_connexion' => 'datetime',
    ];

    /** Laravel utilise ce champ pour le mot de passe */
    public function getAuthPassword()
    {
        return $this->mot_de_passe;
    }
}