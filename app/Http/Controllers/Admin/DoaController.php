<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Doa;
use Illuminate\Http\Request;

class DoaController extends Controller
{
    public function index()
    {
        $doas = Doa::latest()->paginate(10);
        return view('admin.doa.index', compact('doas'));
    }

    public function create()
    {
        return view('admin.doa.create');
    }

   public function store(Request $request)
{
    $request->validate([
        'judul' => 'required',
        'arab' => 'required',
        'latin' => 'required',
        'terjemahan' => 'required', // pastikan ini divalidasi
    ]);

    Doa::create($request->only(['judul', 'arab', 'latin', 'terjemahan'])); // tambahkan terjemahan di sini

    return redirect()->route('admin.doa.index')->with('success', 'Doa berhasil ditambahkan.');
}

  public function edit($id)
{
    $doa = Doa::findOrFail($id);
    return view('admin.doa.edit', compact('doa'));
}


    public function update(Request $request, Doa $doa)
    {
        $request->validate([
            'judul' => 'nullable|string',
            'arab' => 'nullable|string',
            'latin' => 'nullable|string',
            'terjemahan' => 'nullable|string',
        ]);
$doa->update($request->only(['judul', 'arab', 'latin', 'terjemahan']));

        return redirect()->route('admin.doa.index')->with('success', 'Doa berhasil diperbarui.');
    }

   public function destroy($id)
{
    $doa = Doa::findOrFail($id);
    $doa->delete();

    return redirect()->route('admin.doa.index')->with('success', 'Doa berhasil dihapus.');
}

}
