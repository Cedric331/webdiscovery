<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canRegister' => Features::enabled(Features::registration()),
    ]);
})->name('home');

// Blocage des routes login et register (GET et POST) a retirer plus tard pour laisser le fonctionnement normal de Fortify
Route::match(['get', 'post'], '/login', function () {
    return redirect('/');
});

Route::match(['get', 'post'], '/register', function () {
    return redirect('/');
});

Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

Route::get('/mentions-legales', function () {
    return Inertia::render('MentionsLegales');
})->name('mentions-legales');

Route::get('/politique-confidentialite', function () {
    return Inertia::render('PolitiqueConfidentialite');
})->name('politique-confidentialite');

Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

// Sitemap XML
Route::get('/sitemap.xml', function () {
    $baseUrl = rtrim(config('app.url'), '/');
    $lastmod = date('Y-m-d');
    
    $sitemap = '<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:xhtml="http://www.w3.org/1999/xhtml"
        xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
    <url>
        <loc>'.htmlspecialchars($baseUrl, ENT_XML1, 'UTF-8').'</loc>
        <lastmod>'.$lastmod.'</lastmod>
        <changefreq>weekly</changefreq>
        <priority>1.0</priority>
        <xhtml:link rel="alternate" hreflang="fr" href="'.htmlspecialchars($baseUrl, ENT_XML1, 'UTF-8').'" />
        <xhtml:link rel="alternate" hreflang="x-default" href="'.htmlspecialchars($baseUrl, ENT_XML1, 'UTF-8').'" />
    </url>
    <url>
        <loc>'.htmlspecialchars($baseUrl.'/mentions-legales', ENT_XML1, 'UTF-8').'</loc>
        <lastmod>'.$lastmod.'</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.3</priority>
        <xhtml:link rel="alternate" hreflang="fr" href="'.htmlspecialchars($baseUrl.'/mentions-legales', ENT_XML1, 'UTF-8').'" />
    </url>
    <url>
        <loc>'.htmlspecialchars($baseUrl.'/politique-confidentialite', ENT_XML1, 'UTF-8').'</loc>
        <lastmod>'.$lastmod.'</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.3</priority>
        <xhtml:link rel="alternate" hreflang="fr" href="'.htmlspecialchars($baseUrl.'/politique-confidentialite', ENT_XML1, 'UTF-8').'" />
    </url>
</urlset>';

    return response($sitemap, 200)
        ->header('Content-Type', 'application/xml; charset=utf-8')
        ->header('Cache-Control', 'public, max-age=3600');
})->name('sitemap');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/settings.php';
