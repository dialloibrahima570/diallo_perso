<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cv extends Model
{
    protected $fillable = [
        'titre',
        'description',
        'fichier_cv',
        'visible',
    ];
}
