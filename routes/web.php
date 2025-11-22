<?php

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
// Route::match(['get', 'post'], '/login', function () {
//     return redirect('/');
// })->name('login');

// Route::match(['get', 'post'], '/register', function () {
//     return redirect('/');
// })->name('register');

Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

Route::get('/mentions-legales', function () {
    return Inertia::render('MentionsLegales');
})->name('mentions-legales');

Route::get('/politique-confidentialite', function () {
    return Inertia::render('PolitiqueConfidentialite');
})->name('politique-confidentialite');

// Sitemap XML
Route::get('/sitemap.xml', function () {
    $sitemap = '<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>'.config('app.url').'</loc>
        <lastmod>'.date('Y-m-d').'</lastmod>
        <changefreq>weekly</changefreq>
        <priority>1.0</priority>
    </url>
    <url>
        <loc>'.config('app.url').'/mentions-legales</loc>
        <lastmod>'.date('Y-m-d').'</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.3</priority>
    </url>
    <url>
        <loc>'.config('app.url').'/politique-confidentialite</loc>
        <lastmod>'.date('Y-m-d').'</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.3</priority>
    </url>
</urlset>';

    return response($sitemap, 200)->header('Content-Type', 'application/xml');
})->name('sitemap');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/settings.php';
