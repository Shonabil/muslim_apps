<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bookmark;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

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
    $ayat = $surah['ayat'];

    // Tambahkan data audio per ayat secara eksplisit jika tersedia
    foreach ($ayat as &$a) {
        $a['audio'] = $a['audio'] ?? null; // jaga-jaga kalau gak ada
    }

    // Cek apakah hari ini Jumat
    $isFriday = now()->isFriday();

    return view('user.quran.show', compact('surah', 'ayat', 'isFriday'));
}


public function bookmark(Request $request)
{
    $validator = Validator::make($request->all(), [
        'surah_number' => 'required|integer',
        'ayat_number' => 'required|integer',
    ]);

    if ($validator->fails()) {
        return response()->json(['status' => false, 'errors' => $validator->errors()], 422);
    }

    // Cari bookmark user saat ini (kalau ada)
    $bookmark = Bookmark::where('user_id', Auth::id())->first();

    if ($bookmark) {
        // Jika sudah ada, update surah dan ayat-nya
        $bookmark->update([
            'surah_number' => $request->surah_number,
            'ayat_number' => $request->ayat_number,
        ]);
    } else {
        // Jika belum ada, buat baru
        $bookmark = Bookmark::create([
            'user_id' => Auth::id(),
            'surah_number' => $request->surah_number,
            'ayat_number' => $request->ayat_number,
        ]);
    }

    return response()->json(['status' => true, 'message' => 'Bookmark diperbarui', 'data' => $bookmark]);
}


public function unbookmark(Request $request)
{
    $request->validate([
        'surah_number' => 'required|integer',
        'ayat_number' => 'required|integer',
    ]);

    Bookmark::where('user_id', Auth::id())
        ->where('surah_number', $request->surah_number)
        ->where('ayat_number', $request->ayat_number)
        ->delete();

    return response()->json(['status' => true, 'message' => 'Bookmark dihapus']);
}}
