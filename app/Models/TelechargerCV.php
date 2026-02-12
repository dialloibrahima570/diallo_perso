<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TelechargerCV extends Model
{
    use HasFactory;

    protected $table = 'telecharger_cv'; // ici tu précises le nom exact de la table
    protected $fillable = ['name', 'email', 'message', 'status', 'file_path'];
}
