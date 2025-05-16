<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Dzikir;
use Illuminate\Http\Request;

class DzikirController extends Controller
{
    public function index()
    {
        $dzikirs = Dzikir::all();
        return response()->json([
            'status' => 'success',
            'data' => $dzikirs
        ]);
    }

    public function show($id)
    {
        $dzikir = Dzikir::find($id);

        if (!$dzikir) {
            return response()->json([
                'status' => 'error',
                'message' => 'Dzikir not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $dzikir
        ]);
    }
}
