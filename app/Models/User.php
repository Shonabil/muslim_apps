<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory;
    protected $fillable = ['name', 'email', 'password', 'role'];

    use HasApiTokens, HasFactory, Notifiable;


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Get the bookmarks for the user.
     */
    public function bookmarks(): HasMany
    {
        return $this->hasMany(Bookmark::class);
    }

    /**
     * Get the latest bookmark for the user.
     */
    public function latestBookmark()
    {
        return $this->bookmarks()->latest()->first();
    }

    /**
     * Get bookmarks for a specific surah.
     */
    public function bookmarksForSurah(int $surahNumber)
    {
        return $this->bookmarks()->forSurah($surahNumber)->get();
    }

    /**
     * Check if user has bookmarked a specific ayat.
     */
    public function hasBookmark(int $surahNumber, int $ayatNumber): bool
    {
        return $this->bookmarks()
            ->where('surah_number', $surahNumber)
            ->where('ayat_number', $ayatNumber)
            ->exists();
    }
}

