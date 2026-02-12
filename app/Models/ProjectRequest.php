<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectRequest extends Model
{
    use HasFactory;

    // ✅ Autoriser les colonnes pour l'affectation massive
    protected $fillable = [
        'name',
        'email',
        'project',
        'message',
        'status',
        'file_path'
    ];
}
