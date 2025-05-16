<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use League\CommonMark\CommonMarkConverter;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::latest()->get();

        return response()->json([
            'status' => 'success',
            'data' => $articles
        ]);
    }

    public function show($id)
    {
        $article = Article::find($id);

        if (!$article) {
            return response()->json([
                'status' => 'error',
                'message' => 'Article not found'
            ], 404);
        }

        $converter = new CommonMarkConverter();
        $article->content_html = $converter->convert($article->content)->getContent();

        return response()->json([
            'status' => 'success',
            'data' => $article
        ]);
    }
}
