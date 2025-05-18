<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class QuranController extends Controller
{
    // Tampilkan daftar semua surah
    public function index()
    {
        $response = Http::get('https://quran-api.santrikoding.com/api/surah');
        $surahs = $response->json();

        return view('user.quran.dashboard', compact('surahs'));
    }

    // Tampilkan detail surah berdasarkan nomor
   public function show($nomor)
{
    $response = Http::get("https://quran-api.santrikoding.com/api/surah/{$nomor}");
    $surah = $response->json();
    $ayat = $surah['ayat']; // ambil ayatnya saja

    return view('user.quran.show', compact('surah', 'ayat'));
}

}
