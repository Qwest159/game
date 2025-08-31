<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;

use App\Models\Tour;
use App\Models\CaractTour;
use App\Models\User;
use Database\Factories\ToursNiveauFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use App\Models\ToursUser;

class TourController extends Controller
{
    // Acces NIVEAU TOUR Amélioration
    public function index(ToursUser $id)
    {

        // CHANGEMENT D IMAGE TOUR ? AJOUTE UN NOM ?
        // $tour_niveau = CaractTour::where('tour_id', $id->tour_id)->with('tour')->get();

        $user = Auth::user();

        $tour_perso = CaractTour::where('id', $id->caract_tour_id)->with('tour')->first();


        $tour_niveau = CaractTour::where('tour_id', $tour_perso->tour_id)->where('niveau', $tour_perso->niveau + 1)->with('tour')->first();

        // Retourner la vue avec les données
        return Inertia::render('Tour/Index', [
            'tour_perso' => $tour_perso,
            'tour_niveau' => $tour_niveau,
            'tours_user_id' => $id->id,
            'gold' => $user->gold,
        ]);


        // $tour_niveau = CaractTour::where('tour_id', $id->tour_id)->with('tour')->get();

        // $gold = Auth::user()->gold;
        // $tour_up_user = ToursUser::where('tours_level_id', $tour_actuel)->where('user_id', $user->id)->first();

        // // Retourner la vue avec les données
        // return Inertia::render('Tour/Tour_info', [
        //     'tour_perso' => $tour,
        //     'tour_niveau' => $tour_niveau,
        //     'gold' => $gold,
        // ]);
    }

    public function update(ToursUser $id_tour_user, $id_tour_up, $gold_requis)
    {
        // dd($id_tour_up);
        // $tour_up est la tour améliorer
        // Gate::authorize('update', Cure::class);

        $gold_user = Auth::user();

        if ($gold_user->gold >= $gold_requis && $id_tour_up) {
            // reduit gold
            $id_tour_user->caract_tour_id = $id_tour_up;
            $id_tour_user->update();

            $gold_user->gold -= $gold_requis;
            $gold_user->update();

            // $user::update([
            //     'gold' => $gold_restant,
            // ]);

        }
        return redirect()->back();
    }
}
