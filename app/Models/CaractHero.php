<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaractHero extends Model
{
    /** @use HasFactory<\Database\Factories\CaractHeroFactory> */
    use HasFactory;
    public function heroes()
    {
        return $this->HasMany(Hero::class);
    }
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
