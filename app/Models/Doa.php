<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doa extends Model
{
    protected $table = 'doa';

    protected $fillable = [
        'judul',
        'arab',
        'latin',
        'terjemahan',
    ];
}

