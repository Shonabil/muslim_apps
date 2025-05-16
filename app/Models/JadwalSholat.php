<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalSholat extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'location',
        'date',
        'shubuh',
        'dzuhur',
        'ashar',
        'maghrib',
        'isya',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

