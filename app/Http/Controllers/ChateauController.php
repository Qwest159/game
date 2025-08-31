<?php

namespace App\Http\Controllers;

use App\Models\CaractHero;
use App\Models\Hero;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ChateauController extends Controller
{
    public function index()
    {
        $user_id = Auth::user();
        $hero_user = Hero::where('user_id', $user_id->id)->with('caract_hero')->first();

        if (($hero_user->niveau + 1) % 5 === 0) {
            $role_id_upgrade = Role::select('id')->where('niveau_requis', ($hero_user->niveau + 1))->where('role_precedent', $hero_user->role)->first();
            $hero_user_up = CaractHero::where(
                'role_id',
                $role_id_upgrade->id
            )->where('niveau', ($hero_user->niveau + 1))->with('role')->first();
        } else {

            $hero_user_up = CaractHero::where(
                'role_id',
                $hero_user->caract_hero->role_id
            )->where('niveau', $hero_user->niveau + 1)->with('role')->first();
        }


        return Inertia::render('Chateau/Index', [
            'hero_user' => $hero_user,
            'hero_user_up' => $hero_user_up,
        ]);
    }
    function restaurez_vie($hero_id, $hp_full)
    {
        $hero_user = Hero::findOrFail($hero_id);
        $hero_user->hp_restant = $hp_full;
        $hero_user->update();
    }
    function restaurez_vie2($hero_id, $hp_full)
    {
        $hero_user = Hero::findOrFail($hero_id);
        $hero_user->hp_restant = $hp_full;
        $hero_user->update();
    }


    function level_up($hero_id, $caract_hero_id, $exp_requis)
    {
        $hero_user = Hero::findOrFail($hero_id);
        $hero_user->caract_hero_id = $caract_hero_id;
        $hero_user->niveau = $hero_user->niveau + 1;
        $hero_user->exp_restant = 5000;


        $hero_user->update();
        return redirect()->back();
    }
}
