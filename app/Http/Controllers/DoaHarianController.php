<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DoaHarianController extends Controller
{
    public function index()
    {
        $response = Http::get('https://open-api.my.id/api/doa');
        $doas = $response->json();

        return view('user.doa.index', compact('doas'));
    }

    public function show($id)
    {
        try {
            $response = Http::get("https://open-api.my.id/api/doa/{$id}");
            $data = $response->json();

            if ($response->successful() && isset($data['data'])) {
                $doa = $data['data'];
                return view('doa_harian.show', compact('doa'));
            } else {
                // Handle jika API gagal atau struktur datanya tidak sesuai
                return view('user.doa.show', ['message' => 'Gagal mengambil data dari API.']);
            }
        } catch (\Exception $e) {
            // Handle jika terjadi exception saat menghubungi API
            return view('user.doa.show', ['message' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
}
