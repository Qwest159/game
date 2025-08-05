<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;

use App\Models\Tour;
use App\Models\ToursLevel;
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

        // CHANGEMENT D IMAGE TOUR ? AJOUTE UN NOM
        // $tour_niveau = ToursLevel::where('tour_id', $id->tour_id)->with('tour')->get();

        $user = Auth::user();

        $tour_perso = ToursLevel::where('id', $id->tours_level_id)->with('tour')->first();


        $tour_niveau = ToursLevel::where('tour_id', $tour_perso->tour_id)->where('niveau', $tour_perso->niveau + 1)->with('tour')->first();

        // Retourner la vue avec les données
        return Inertia::render('Tour/Tour_info', [
            'tour_perso' => $tour_perso,
            'tour_niveau' => $tour_niveau,
            'tours_user_id' => $id->id,
            'gold' => $user->gold,
        ]);

        //     // CHANGEMENT D IMAGE TOUR ? AJOUTE UN NOM
        // $tour_niveau = ToursLevel::where('tour_id', $id->tour_id)->with('tour')->get();

        // $gold = Auth::user()->gold;
        // $tour_up_user = ToursUser::where('tours_level_id', $tour_actuel)->where('user_id', $user->id)->first();

        // // Retourner la vue avec les données
        // return Inertia::render('Tour/Tour_info', [
        //     'tour_perso' => $tour,
        //     'tour_niveau' => $tour_niveau,
        //     'gold' => $gold,
        // ]);













    }







    // public function edit($id)
    // {
    //     // Gate = limite à admin
    //     Gate::authorize('edit', Cure::class);
    //     $Chambre = Chambre::findOrFail($id);

    //     return Inertia::render('Admin/Chambres/Edit', [
    //         'chambre' => $Chambre,
    //     ]);
    // }

    public function update(ToursUser $id_tour_user, $id_tour_up, $gold_requis)
    {
        // dd($id_tour_up);
        // $tour_up est la tour améliorer
        // Gate::authorize('update', Cure::class);

        $gold_user = Auth::user();

        if ($gold_user->gold >= $gold_requis && $id_tour_up) {
            // reduit gold
            $id_tour_user->tours_level_id = $id_tour_up;
            $id_tour_user->update();

            $gold_user->gold -= $gold_requis;
            $gold_user->update();

            // $user::update([
            //     'gold' => $gold_restant,
            // ]);

        }
        return redirect()->back();
    }
    // public function destroy($id)
    // {
    //     Gate::authorize('destroy', Cure::class);

    //     // Gate::authorize('delete', $article);
    //     $Chambre = Chambre::findOrFail($id);
    //     $Chambre->delete();

    //     return redirect()->back();
    // }
}



     // validation
        // $validatedData = $request->validate([
        //     'nom' => 'required|string|max:15|min:1',
        //     'img_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        //     'nbr_personnes' => 'required|string|max:5|min:1',
        //     'nbr_lit' => 'required|string|max:5|min:1',
        //     'nbr_sdb' => 'required|string|max:5|min:1',
        //     'description' => 'required|string|max:150',
        //     'disponible' => 'required|boolean',

        // ]);
        // $Chambre->nom = $validatedData['nom'];

        // // Si une nouvelle image est envoyée, mettre à jour le chemin de l'image
        // if ($request->hasFile('img_path')) {
        //     $Chambre->img_path = $request->file('img_path')->store('chambres', 'public');
        // }

        // $Chambre->nbr_personnes = $validatedData['nbr_personnes'];
        // $Chambre->nbr_lit = $validatedData['nbr_lit'];
        // $Chambre->nbr_sdb = $validatedData['nbr_sdb'];;
        // $Chambre->description = $validatedData['description'];
        // $Chambre->disponible = $validatedData['disponible'];

        // Sauvegarder les modifications dans la base de données
        // $Chambre->save();

        // return redirect()->back();
