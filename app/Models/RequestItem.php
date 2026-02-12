<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class RequestItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',       // 'contact', 'project', 'cv'
        'name',
        'email',
        'project_name',
        'message',
        'status',
        'admin_message',
    ];
}
