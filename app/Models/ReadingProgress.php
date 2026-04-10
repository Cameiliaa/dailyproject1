<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReadingProgress extends Model
{
    protected $fillable = [
    'user_id',
    'file_id',
    'last_page'
];
}

