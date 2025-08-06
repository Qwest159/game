<?php

namespace App\Http\Controllers;

use App\Models\Hero;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class OutsideController extends Controller
{
    public function index()
    {

        // ajoute monstre

        $hero_user = Role::where('id', Auth::user()->role_id)->with('hero')->first();

        // Retourner la vue avec les données
        return Inertia::render('Outside/Index', [
            'hero_user' => $hero_user,
        ]);
    }
}
