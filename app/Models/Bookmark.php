<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    protected $fillable = ['user_id', 'surah_number', 'ayat_number'];
}

