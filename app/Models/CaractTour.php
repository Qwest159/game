<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaractTour extends Model
{
    /** @use HasFactory<\Database\Factories\CaractTourFactory> */
    use HasFactory;

    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }
}
