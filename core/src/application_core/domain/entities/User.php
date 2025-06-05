<?php

namespace App\application_core\domain\entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Modèle Eloquent représentant un utilisateur.
 * Correspond à la table "user" en base de données.
 */

class User extends Model {
    protected $table = 'User';
    public $timestamps = false;
    protected $fillable = [
        'email',
        'password',
        'role'
    ];

    public $incrementing = false;
    protected $keyType = 'string';
}
