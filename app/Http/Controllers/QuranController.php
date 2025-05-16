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

        return view('user.quran.show', compact('surah'));
    }

    public function bookmark(Request $request)
    {
        $response = Http::post('https://quran-api.santrikoding.com/api/bookmark', [
            'user_id' => Auth::id(),
            'surah_id' => $request->input('surah_id'),
            'ayat_number' => $request->input('ayat_number'),
            'surah_name' => $request->input('surah_name'),
        ]);

        return response()->json($response->json());
    }
}
