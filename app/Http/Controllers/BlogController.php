<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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

        // Transformer les articles pour s'assurer que les URLs des médias sont absolues
        $articles->getCollection()->transform(function ($article) {
            if ($article->media) {
                $article->media->transform(function ($media) {
                    // Utiliser getUrl() qui génère le bon chemin relatif
                    $url = $media->getUrl();
                    // Convertir en URL absolue
                    if (!str_starts_with($url, 'http')) {
                        $url = url($url);
                    }
                    $media->url = $url;
                    return $media;
                });
            }
            return $article;
        });

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

        $article->load('media');

        // S'assurer que les URLs des médias sont absolues
        if ($article->media) {
            $article->media->transform(function ($media) {
                // Utiliser getUrl() qui génère le bon chemin relatif
                $url = $media->getUrl();
                // Convertir en URL absolue
                if (!str_starts_with($url, 'http')) {
                    $url = url($url);
                }
                $media->url = $url;
                return $media;
            });
        }

        return Inertia::render('Blog/Show', [
            'article' => $article,
        ]);
    }
}

