<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSetting extends Model
{
    use HasFactory;

    // Table associée (optionnel si le nom suit la convention)
    protected $table = 'user_settings';

    // Champs pouvant être remplis en masse
    protected $fillable = [
        'user_id',
        'notifications',
        'notification_types',
        'dark_mode',
        'theme_color',
        'language',
        'timezone',
    ];

    // Casts pour gérer les types
    protected $casts = [
        'notifications' => 'boolean',
        'notification_types' => 'array', // JSON converti automatiquement en array
        'dark_mode' => 'boolean',
    ];

    // Relation avec l'utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
