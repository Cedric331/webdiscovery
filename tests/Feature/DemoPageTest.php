<?php

use App\Http\Controllers\DemoController;
use App\Models\Demo;
use Illuminate\Support\Facades\Storage;
use Inertia\Testing\AssertableInertia;

test('la landing page coach sportif est accessible', function () {
    $this->get(route('demo.coach-sportif'))
        ->assertOk()
        ->assertInertia(fn (AssertableInertia $page) => $page
            ->component('Demos/CoachSportif')
            ->has('demo.faq', 8)
            ->has('structuredData', 2)
        );
});

test('la migration amorce une ligne par démo déclarée dans le code', function () {
    expect(Demo::count())->toBe(count(DemoController::registry()));
});

test('le tarif saisi en back-office remplace celui du registre', function () {
    Demo::where('slug', 'site-coach-sportif')->update(['price' => 790]);

    $this->get(route('demo.coach-sportif'))
        ->assertInertia(fn (AssertableInertia $page) => $page->where('demo.price', 790));
});

test('le registre du code sert de repli sans ligne en base', function () {
    Demo::query()->delete();

    $this->get(route('demo.coach-sportif'))
        ->assertOk()
        ->assertInertia(fn (AssertableInertia $page) => $page
            ->where('demo.price', DemoController::registry()['coach-sportif']['price'])
        );
});

test('les captures du dossier public servent de repli', function () {
    $this->get(route('demo.coach-sportif'))
        ->assertInertia(fn (AssertableInertia $page) => $page
            ->where('demo.screenshots.desktop', '/images/demos/coach-sportif-desktop.png')
            ->where('demo.screenshots.mobile', '/images/demos/coach-sportif-mobile.png')
        );
});

test('une démo inconnue renvoie une 404', function () {
    $this->get('/site-coach-sportif/inexistant')->assertNotFound();
});

test('une capture déposée en back-office prend le dessus sur le fichier public', function () {
    Storage::fake(Demo::MEDIA_DISK);

    $png = base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mP8z8BQDwAEhQGAhKmMIQAAAABJRU5ErkJggg==');

    Demo::where('slug', 'site-coach-sportif')->firstOrFail()
        ->addMediaFromString($png)
        ->usingFileName('apercu-desktop.png')
        ->toMediaCollection(Demo::MEDIA_SCREENSHOT_DESKTOP);

    $this->get(route('demo.coach-sportif'))
        ->assertInertia(fn (AssertableInertia $page) => $page
            ->where('demo.screenshots.desktop', fn (?string $url) => str_contains((string) $url, 'apercu-desktop.png'))
            ->where('demo.screenshots.mobile', '/images/demos/coach-sportif-mobile.png')
        );
});
