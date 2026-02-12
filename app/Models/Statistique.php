<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Statistique extends Model
{
    protected $table = 'statistiques';

    protected $fillable = [
        'annees_experience',
        'projets_realises',
        'clients_satisfaits',
    ];
}
