<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Doa;
use Illuminate\Http\Request;

class DoaController extends Controller
{
    /**
     * Menampilkan daftar doa untuk user.
     */
 public function index(Request $request)
{
    $search = $request->input('search');

    $doas = Doa::when($search, function ($query, $search) {
        return $query->where('judul', 'like', "%{$search}%")
                     ->orWhere('arab', 'like', "%{$search}%")
                     ->orWhere('latin', 'like', "%{$search}%")
                     ->orWhere('terjemahan', 'like', "%{$search}%");
    })->paginate(3); // <- pagination aktif

    return view('user.doa.index', compact('doas', 'search')); 
}

    /**
     * Menampilkan detail doa berdasarkan ID.
     */
    public function show($id)
    {
        $doa = Doa::findOrFail($id);
        return view('user.doa.show', compact('doa'));
    }
}
