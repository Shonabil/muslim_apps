<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quran extends Model
{
    use HasFactory;

    protected $fillable = [
        'surah_number',
        'surah_name',
        'latin_translation',
        'translation',
        'category',
    ];
}

