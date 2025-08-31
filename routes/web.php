<?php

use App\Http\Controllers\AccueilController;
use App\Http\Controllers\ChateauController;
use App\Http\Controllers\NewAccountController;
use App\Http\Controllers\OutsideController;
use App\Http\Controllers\TourController;
use App\Models\Chateau;
use App\Models\Outside;
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

    // création de compte
    Route::get('/new', [NewAccountController::class, 'index'])->name('new');
    Route::post('/new/creation', [NewAccountController::class, 'creation_compte'])->name('creation_compte');


    // ---------- TOUR ------------

    Route::get('/tour_info/{id}', [TourController::class, 'index'])->name('tour_info');
    Route::post('/tour_info/update/{id_tour_user}/{id_tour_up}/{gold_requis}', [TourController::class, "update"])->name('tour_info.update');

    // ---------- CHATEAU ------------

    Route::get('/chateau', [ChateauController::class, 'index'])->name('chateau');
    Route::post('/chateau/vie/{hero_id}/{hp_full}', [ChateauController::class, 'restaurez_vie'])->name('restaurez_vie');

    Route::post('/chateau/level_up/{hero_id}/{caract_hero_id}/{exp_requis}', [ChateauController::class, 'level_up'])->name('level_up');
    // --------- OUTSIDE ----------
    Route::get('/outside', [OutsideController::class, 'index'])->name('outside');
    Route::post('/outside/partir/', [OutsideController::class, 'partir'])->name('partir');


    // ----- Chambre-----
    // Route::get('/cure_tour', [AdminChambreController::class, 'index'])->name('cure_chambre');
    // Route::get('/cure_chambre/create', [AdminChambreController::class, "create"])->name('cure_chambre.create');
    // Route::post('/cure_chambre/store', [AdminChambreController::class, "store"])->name('cure_chambre.store');
    // Route::get('/cure_chambre/edit/{id}', [AdminChambreController::class, "edit"])->name('cure_chambre.edit');


});
