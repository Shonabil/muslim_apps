<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Article;
use League\CommonMark\CommonMarkConverter;
use Illuminate\Http\Request;
class ArticleController extends Controller
{

public function index(Request $request)
{
    $search = $request->input('search');

    $articles = Article::query()
        ->when($search, function ($query) use ($search) {
            $query->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
        })
        ->latest()
        ->paginate(9);

    return view('user.article.index', compact('articles'));
}


    public function show(Article $article)
    {
        $converter = new CommonMarkConverter();
        $article->content_html = $converter->convert($article->content)->getContent();
        return view('user.article.show', compact('article'));
    }
}
