<?php

namespace App\Http\Controllers;

use App\Models\Attaque;
use App\Models\AttaqueUser;
use App\Models\CaractMonstre;
use App\Models\Hero;
use App\Models\Monstre;
use App\Models\Outside;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class OutsideController extends Controller
{
    public function index()
    {

        // ajoute monstre
        $user_id = Auth::user()->id;
        $hero_user = Hero::where('user_id', $user_id)->with('caract_hero')->first();
        $monstre = Monstre::select('img_path')->get();
        $carac_monst =  CaractMonstre::select('id', 'hp', 'att', 'def', 'exp', 'niveau')->get();
        $outside_map = Outside::select('img_path')->limit(9)->get();

        $attaques_user = Attaque::whereHas('users', function ($query) {

            $query->where('attaque_users.user_id', Auth::user()->id);
        })->get();

        // Retourner la vue avec les données
        return Inertia::render('Outside/Index', [
            'hero_user' => $hero_user,
            'monstre' => $monstre,
            'carac_monst' => $carac_monst,
            'outside_map' => $outside_map,
            'attaques_user' => $attaques_user,
        ]);
    }
    public function partir(Request $request)
    {
        // RECOIT L'OBJET GAIN (contient le butin du joueur)
        $validatedData = $request->validate([
            'gain.exp' => 'required|int',
            'gain.or' => 'required|int',
            'gain.hp_restant' => 'required|int',

        ]);
        $user = User::select('id', 'gold')->where('id', Auth::user()->id)->with('heroes')->first();


        // ATTENTION SI PLUSIEURS HERO !!!!!
        $user->gold += $validatedData['gain']['or'];
        $user->update();


        $user->heroes[0]->exp_restant += $validatedData['gain']['exp'];
        $user->heroes[0]->hp_restant = $validatedData['gain']['hp_restant'];

        $user->heroes[0]->update();

        // Retourner la vue avec les données
        return redirect()->route('accueil');
    }
}
