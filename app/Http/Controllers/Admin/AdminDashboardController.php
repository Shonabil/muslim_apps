<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Article;
use App\Models\Dzikir;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $userCount = User::count();
        $articleCount = Article::count();
        $dzikirCount = Dzikir::count();

        return view('admin.dashboard', [
            'userCount' => $userCount,
            'articleCount' => $articleCount,
            'dzikirCount' => $dzikirCount,
        ]);
    }
}
