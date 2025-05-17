<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Doa;
use Illuminate\Http\Request;

class DoaController extends Controller
{
    // List semua doa, bisa paginasi atau full
    public function index()
    {
        $doas = Doa::all();  // atau paginate jika banyak
        return response()->json([
            'success' => true,
            'data' => $doas,
        ]);
    }

    // Detail satu doa berdasarkan id
    public function show($id)
    {
        $doa = Doa::find($id);

        if (!$doa) {
            return response()->json([
                'success' => false,
                'message' => 'Doa tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $doa,
        ]);
    }
}
