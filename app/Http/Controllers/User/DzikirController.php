<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Dzikir;
use Illuminate\Http\Request;

class DzikirController extends Controller
{
    public function index()
    {
        $dzikirs = Dzikir::all();  // <= Pastikan ini $dzikirs
        return view('user.dzikir.index', compact('dzikirs'));
    }

public function show(Dzikir $dzikir)
{
    return view('user.dzikir.show', compact('dzikir'));
}
}
