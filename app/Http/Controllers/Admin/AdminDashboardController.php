<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Article;
use App\Models\Dzikir;
use App\Models\Doa;
use App\Models\LoginLog;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $userCount = User::count();
        $articleCount = Article::count();
        $dzikirCount = Dzikir::count();
        $doaCount = Doa::count();
        $loginLogs = LoginLog::with('user')->latest()->take(3)->get();

        $startOfThisWeek = Carbon::now()->startOfWeek();
        $startOfLastWeek = Carbon::now()->subWeek()->startOfWeek();
        $endOfLastWeek = Carbon::now()->subWeek()->endOfWeek();

        $usersLastWeek = User::whereBetween('created_at', [$startOfLastWeek, $endOfLastWeek])->count();
        $usersThisWeek = User::where('created_at', '>=', $startOfThisWeek)->count();

        $userGrowth = $usersLastWeek > 0
            ? round((($usersThisWeek - $usersLastWeek) / $usersLastWeek) * 100)
            : ($usersThisWeek > 0 ? 100 : 0);

        $articlesLastWeek = Article::whereBetween('created_at', [$startOfLastWeek, $endOfLastWeek])->count();
        $articlesThisWeek = Article::where('created_at', '>=', $startOfThisWeek)->count();

        $articleGrowth = $articlesLastWeek > 0
            ? round((($articlesThisWeek - $articlesLastWeek) / $articlesLastWeek) * 100)
            : ($articlesThisWeek > 0 ? 100 : 0);

        $dzikirsLastWeek = Dzikir::whereBetween('created_at', [$startOfLastWeek, $endOfLastWeek])->count();
        $dzikirsThisWeek = Dzikir::where('created_at', '>=', $startOfThisWeek)->count();

        $dzikirGrowth = $dzikirsLastWeek > 0
            ? round((($dzikirsThisWeek - $dzikirsLastWeek) / $dzikirsLastWeek) * 100)
            : ($dzikirsThisWeek > 0 ? 100 : 0);

        $doasLastWeek = Doa::whereBetween('created_at', [$startOfLastWeek, $endOfLastWeek])->count();
        $doasThisWeek = Doa::where('created_at', '>=', $startOfThisWeek)->count();

        $doaGrowth = $doasLastWeek > 0
            ? round((($doasThisWeek - $doasLastWeek) / $doasLastWeek) * 100)
            : ($doasThisWeek > 0 ? 100 : 0);


        return view('admin.dashboard', compact(
            'userCount',
            'articleCount',
            'dzikirCount',
            'doaCount',
            'loginLogs',
            'userGrowth',
            'articleGrowth',
    'dzikirGrowth',
    'doaGrowth'
        ));
    }
}
