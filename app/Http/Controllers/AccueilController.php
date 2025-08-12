<?php

namespace App\Http\Controllers;

use App\Models\CaractTour;

use App\Models\ToursUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AccueilController extends Controller
{
    public function index()
    {

        $tours_user = ToursUser::select('id', 'caract_tour_id')->where('user_id', Auth::id())->orderBY('caract_tour_id')->get();
        // $tours_id =  $tours_user->pluck('id');
        // $tours_idlevel = $tours_user->pluck('tours_level_id');

        foreach ($tours_user as $key => $value) {
            $tours_id_user[$key] =  $tours_user[$key]['id'];
            $caract_tour_id[$key] = $tours_user[$key]['caract_tour_id'];
        }
        $tours = CaractTour::whereIn('id', $caract_tour_id)->with('tour')->orderBy('id')->get();
        return Inertia::render('Dashboard', [
            'tours' => $tours,
            'tours_id_user' => $tours_id_user
        ]);
    }
}
