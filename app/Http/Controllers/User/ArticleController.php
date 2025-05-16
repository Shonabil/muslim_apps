<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Article;
use League\CommonMark\CommonMarkConverter;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::latest()->get();
        return view('user.article.index', compact('articles'));
    }

    public function show(Article $article)
    {
        $converter = new CommonMarkConverter();
        $article->content_html = $converter->convert($article->content)->getContent();
        return view('user.article.show', compact('article'));
    }
}
