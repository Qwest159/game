<?php

namespace App\Http\Controllers;

use App\Models\Attaque;
use App\Models\AttaqueUser;
use App\Models\CaractHero;
use App\Models\CaractTour;
use App\Models\Hero;
use App\Models\Personnage;
use App\Models\Role;
use App\Models\ToursUser;
use Database\Seeders\RoleSeeder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;

class NewAccountController extends Controller
{
    public function index()
    {
        $user_new = Auth::user()->new;
        if ($user_new) {
            $tours = CaractTour::where('niveau', 1)->with('tour')->orderBy('id')->get();
            $caract_hero = CaractHero::where("niveau", 1)->with('role')->get();
            $perso_hero = Personnage::all();

            return Inertia::render('NewAccount/Index', [
                'tours' => $tours,
                'caract_hero' => $caract_hero,
                'perso_hero' => $perso_hero,

            ]);
        } else {
            return redirect()->route('accueil');
        }
    }
    public function creation_compte(Request $request)
    {
        $user_new = Auth::user()->new;
        if ($user_new) {
            $validatedData = $request->validate([
                'tour' => 'required|array|size:3',
                'tour.*' => 'required',
                'integer',
                'rôle' => 'required|integer',
                'portrait' => 'required|integer',
            ]);

            function netoyageCharactere($donnee_recu)
            {
                $donnee = trim($donnee_recu);
                // ENT_COMPAT => évite de transformer le ' en caractère
                $donnee_final =  htmlspecialchars($donnee);
                return $donnee_final;
            }


            $role_secu = CaractHero::with('role')->findOrFail(netoyageCharactere($validatedData['rôle']));
            $portrait_secu = Personnage::findOrFail(netoyageCharactere($validatedData['portrait']));

            $tableau_secu_tour = [];
            $user = Auth::user();


            foreach ($validatedData['tour'] as $key => $tour_id) {
                $tableau_secu_tour[$key] = CaractTour::findOrFail(netoyageCharactere($tour_id));
            }


            foreach ($tableau_secu_tour as $key => $tour_id) {
                $tour = new ToursUser();
                $tour->caract_tour_id = $tour_id->id;
                $tour->user_id = $user->id;
                $tour->hp_restant = $tour_id->hp;
                $tour->save();
            };

            $hero = new Hero();
            $hero->img_path = $portrait_secu->img_path;
            $hero->role = $role_secu->role->role;
            $hero->portrait = $portrait_secu->portrait;
            $hero->niveau = 1;
            $hero->hp_restant = $role_secu->hp;
            $hero->exp_restant = 0;
            $hero->caract_hero_id = $role_secu->id;
            $hero->user_id = $user->id;
            $hero->save();

            $tableau_attaque = Attaque::select('id')->where('niveau', 1)->where('role_id', $role_secu->role->id)->limit(4)->get();

            foreach ($tableau_attaque as $key => $attaque) {
                $attaque_user = new AttaqueUser();
                $attaque_user->attaque_id = $attaque->id;
                $attaque_user->user_id = $user->id;
                $attaque_user->save();
            }


            // ----- le joueur a créé son compte -------
            $user->new = false;
            $user->update();
        }
        return redirect()->route('accueil');
    }
}
