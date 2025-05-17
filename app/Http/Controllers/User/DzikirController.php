<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Dzikir;
use Illuminate\Http\Request;

class DzikirController extends Controller
{
  public function index(Request $request)
{
    $search = $request->input('search');

    $dzikirs = Dzikir::when($search, function ($query, $search) {
        return $query->where('title', 'like', "%{$search}%")
                     ->orWhere('arabic_text', 'like', "%{$search}%")
                     ->orWhere('latin_translation', 'like', "%{$search}%")
                     ->orWhere('translation', 'like', "%{$search}%");
    })->paginate(3);

    return view('user.dzikir.index', compact('dzikirs', 'search'));
}



public function show(Dzikir $dzikir)
{
    return view('user.dzikir.show', compact('dzikir'));
}
}
