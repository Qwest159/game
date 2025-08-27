<?php

namespace App\Http\Controllers;

use App\Models\Hero;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ChateauController extends Controller
{
    public function index($id)
    {

        $user_id = User::findOrFail($id);
        $hero_user = Hero::where('user_id', $user_id)->with('caract_hero')->first();


        // Retourner la vue avec les données
        return Inertia::render('Chateau/Index', [
            'hero_user' => $hero_user,
        ]);
    }
}
