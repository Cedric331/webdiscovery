<?php

use App\Http\Controllers\CustomerPortal\AuthController;
use App\Http\Controllers\CustomerPortal\ContractController;
use App\Http\Controllers\CustomerPortal\DashboardController;
use App\Http\Controllers\CustomerPortal\InterventionController;
use App\Http\Controllers\CustomerPortal\InvoiceController;
use App\Http\Controllers\CustomerPortal\MediaController;
use App\Http\Controllers\CustomerPortal\QuoteController;
use App\Http\Middleware\CustomerPortalAuth;
use Illuminate\Support\Facades\Route;

Route::prefix('espace-client')->name('customer-portal.')->group(function () {
    Route::get('/', fn () => redirect()->route('customer-portal.dashboard'));

    Route::get('/connexion', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/connexion', [AuthController::class, 'login'])->name('login.store');
    Route::post('/deconnexion', [AuthController::class, 'logout'])->name('logout');

    Route::middleware(CustomerPortalAuth::class)->group(function () {
        Route::get('/tableau-de-bord', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/factures', [InvoiceController::class, 'index'])->name('invoices');
        Route::get('/devis', [QuoteController::class, 'index'])->name('quotes');
        Route::get('/interventions', [InterventionController::class, 'index'])->name('interventions');
        Route::get('/contrat-maintenance', [ContractController::class, 'index'])->name('contract');
        Route::get('/documents/{type}/{id}/telecharger', [MediaController::class, 'download'])
            ->name('documents.download')
            ->whereIn('type', ['invoice', 'quote', 'intervention', 'contract'])
            ->whereNumber('id');
    });
});
