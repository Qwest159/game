<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToursLevel extends Model
{
    /** @use HasFactory<\Database\Factories\ToursLevelFactory> */
    use HasFactory;
    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }
}
