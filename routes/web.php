<?php

use App\Http\Controllers\AccueilController;
use App\Http\Controllers\TourController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/accueil', [AccueilController::class, 'index'])->name('accueil');


    Route::get('/tour_info/{id}', [TourController::class, 'index'])->name('tour_info');
    // Route::get('/tour_info/edit/{gold}/{tour}', [TourController::class, "edit"])->name('tour_info.edit');
    Route::post('/tour_info/update/{tour_up}/{tour_actuel}/{gold_user}', [TourController::class, "update"])->name('tour_info.update');
    // ----- Chambre-----
    // Route::get('/cure_tour', [AdminChambreController::class, 'index'])->name('cure_chambre');
    // Route::get('/cure_chambre/create', [AdminChambreController::class, "create"])->name('cure_chambre.create');
    // Route::post('/cure_chambre/store', [AdminChambreController::class, "store"])->name('cure_chambre.store');
    // Route::get('/cure_chambre/edit/{id}', [AdminChambreController::class, "edit"])->name('cure_chambre.edit');


});
