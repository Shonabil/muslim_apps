<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoaHarian extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'judul',
        'latin_translation',
        'arabic_text',
        'translation',

    ];
}

