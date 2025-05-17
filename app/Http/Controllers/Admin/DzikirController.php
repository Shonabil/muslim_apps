<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dzikir;
use Illuminate\Http\Request;

class DzikirController extends Controller
{
    public function index()
    {
        $dzikirs = Dzikir::paginate(2);  // Ini akan menghasilkan hasil paginasi

        return view('admin.dzikir.index', compact('dzikirs'));
    }

    public function create()
    {
        return view('admin.dzikir.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'arabic_text' => 'nullable|string',
            'latin_translation' => 'nullable|string',
            'translation' => 'nullable|string',
        ]);

        Dzikir::create($request->all());

        return redirect()->route('admin.dzikir.index')->with('success', 'Dzikir berhasil ditambahkan.');
    }

    public function edit(Dzikir $dzikir)
    {
        return view('admin.dzikir.edit', compact('dzikir'));
    }

    public function update(Request $request, Dzikir $dzikir)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'arabic_text' => 'nullable|string',
            'latin_translation' => 'nullable|string',
            'translation' => 'nullable|string',
        ]);

        $dzikir->update($request->all());

        return redirect()->route('admin.dzikir.index')->with('success', 'Dzikir berhasil diperbarui.');
    }

    public function destroy(Dzikir $dzikir)
    {
        $dzikir->delete();
        return redirect()->route('admin.dzikir.index')->with('success', 'Dzikir berhasil dihapus.');
    }
}
