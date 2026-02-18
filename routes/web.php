<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\ConcoursController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ServiceController;
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

Route::get('/concours', function () {
    return Inertia::render('Concours');
})->name('concours');

Route::get('/participation-concours', [ConcoursController::class, 'show'])->name('participation-concours');
Route::post('/participation-concours', [ConcoursController::class, 'store'])->name('participation-concours.store');

Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

Route::get('/portfolio', [PortfolioController::class, 'index'])->name('portfolio.index');

// Pages métiers (SEO)
Route::get('/creation-site-web-artisan', fn() => app(ServiceController::class)->show('artisan'))->name('service.artisan');
Route::get('/creation-site-web-coiffeur', fn() => app(ServiceController::class)->show('coiffeur'))->name('service.coiffeur');
Route::get('/creation-site-web-plombier', fn() => app(ServiceController::class)->show('plombier'))->name('service.plombier');
Route::get('/creation-site-web-electricien', fn() => app(ServiceController::class)->show('electricien'))->name('service.electricien');
Route::get('/creation-site-web-menuisier', fn() => app(ServiceController::class)->show('menuisier'))->name('service.menuisier');

// Sitemap XML
Route::get('/sitemap.xml', function () {
    $baseUrl = rtrim(config('app.url'), '/');
    $lastmod = date('Y-m-d');
    
    // Pages principales
    $urls = [
        ['url' => $baseUrl, 'priority' => '1.0', 'changefreq' => 'weekly'],
        ['url' => $baseUrl . '/blog', 'priority' => '0.8', 'changefreq' => 'weekly'],
        ['url' => $baseUrl . '/portfolio', 'priority' => '0.8', 'changefreq' => 'monthly'],
    ];
    
    // Pages métiers (SEO)
    $services = [
        '/creation-site-web-artisan',
        '/creation-site-web-coiffeur',
        '/creation-site-web-plombier',
        '/creation-site-web-electricien',
        '/creation-site-web-menuisier',
    ];
    
    foreach ($services as $service) {
        $urls[] = [
            'url' => $baseUrl . $service,
            'priority' => '0.9',
            'changefreq' => 'monthly',
        ];
    }
    
    // Pages légales
    $urls[] = ['url' => $baseUrl . '/mentions-legales', 'priority' => '0.3', 'changefreq' => 'monthly'];
    $urls[] = ['url' => $baseUrl . '/politique-confidentialite', 'priority' => '0.3', 'changefreq' => 'monthly'];
    
    // Articles du blog (si vous voulez les inclure)
    try {
        $articles = \App\Models\Article::whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->get(['slug', 'updated_at']);
        
        foreach ($articles as $article) {
            $urls[] = [
                'url' => $baseUrl . '/blog/' . $article->slug,
                'priority' => '0.7',
                'changefreq' => 'monthly',
                'lastmod' => $article->updated_at->format('Y-m-d'),
            ];
        }
    } catch (\Exception $e) {
        // Ignore si la table n'existe pas encore
    }
    
    $sitemap = '<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:xhtml="http://www.w3.org/1999/xhtml"
        xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">';
    
    foreach ($urls as $urlData) {
        $url = htmlspecialchars($urlData['url'], ENT_XML1, 'UTF-8');
        $priority = $urlData['priority'];
        $changefreq = $urlData['changefreq'];
        $lastmod = isset($urlData['lastmod']) ? $urlData['lastmod'] : $lastmod;
        
        $sitemap .= '
    <url>
        <loc>' . $url . '</loc>
        <lastmod>' . $lastmod . '</lastmod>
        <changefreq>' . $changefreq . '</changefreq>
        <priority>' . $priority . '</priority>
        <xhtml:link rel="alternate" hreflang="fr" href="' . $url . '" />
        <xhtml:link rel="alternate" hreflang="x-default" href="' . $url . '" />
    </url>';
    }
    
    $sitemap .= '
</urlset>';

    return response($sitemap, 200)
        ->header('Content-Type', 'application/xml; charset=utf-8')
        ->header('Cache-Control', 'public, max-age=3600');
})->name('sitemap');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/settings.php';
