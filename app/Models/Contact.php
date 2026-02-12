<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    // Champs remplissables
    protected $fillable = [
        'name',
        'email',
        'subject',
        'message',
        'status' // nouveau champ pour gérer lu/non lu
    ];

    // Valeur par défaut pour le status
    protected $attributes = [
        'status' => 'unread', // par défaut, tout nouveau message est non lu
    ];
}
