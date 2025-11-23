<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $articles = Article::query()
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->with('media')
            ->orderBy('published_at', 'desc')
            ->paginate(6);

        return Inertia::render('Blog/Index', [
            'articles' => $articles,
        ]);
    }

    public function show($slug)
    {
        $article = Article::where('slug', $slug)->firstOrFail();

        // Vérifier que l'article est publié
        if (!$article->published_at || $article->published_at->isFuture()) {
            abort(404);
        }

        return Inertia::render('Blog/Show', [
            'article' => $article->load('media'),
        ]);
    }
}

