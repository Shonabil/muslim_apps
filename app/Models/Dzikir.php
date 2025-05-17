<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dzikir extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'arabic_text',
        'latin_translation',
        'translation',
        'fadhilah',
    ];

    // Kita bisa menambahkan scope untuk filter berdasarkan kategori

}
