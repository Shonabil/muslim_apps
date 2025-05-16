<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class jadwalsholatController extends Controller
{
    public function jadwal(Request $request)
    {
        $lat = $request->input('lat');
        $lng = $request->input('lng');

        if ($lat && $lng) {
            // Pakai API berdasarkan geolokasi
            $geoUrl = "https://api.myquran.com/v1/sholat/jadwal/geo?latitude={$lat}&longitude={$lng}";
            $response = Http::get($geoUrl);
            $jadwal_shalat = $response->json('data');

            return view('user.jadwal.index', compact('jadwal_shalat', 'lat', 'lng'));
        } else {
            // Default pakai kode kota
            $kodeKota = $request->input('kodeKota', '0119');
            $tahun = $request->input('tahun', now()->year);
            $bulan = $request->input('bulan', now()->month);
            $tanggal = $request->input('tanggal', now()->day);

            $api_kota = Http::get("https://api.myquran.com/v2/sholat/kota/semua");
            $apiUrl = "https://api.myquran.com/v2/sholat/jadwal/{$kodeKota}/{$tahun}/{$bulan}/{$tanggal}";

            $response = Http::get($apiUrl);
            $jadwal_shalat = $response->json('data');
            $kota = $api_kota->json('data');

            return view('user.jadwal.index', compact('jadwal_shalat','kota', 'kodeKota', 'tahun', 'bulan', 'tanggal'));
        }
    }

}
