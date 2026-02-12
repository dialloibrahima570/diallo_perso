<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    protected $table = 'history'; // <--- important
    protected $fillable = ['action', 'email', 'request_item_id', 'type', 'message'];
}
