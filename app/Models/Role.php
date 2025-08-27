<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /** @use HasFactory<\Database\Factories\RoleFactory> */
    use HasFactory;

    public function attaques()
    {
        return $this->hasMany(Attaque::class);
    }
    public function caract_heroes()
    {
        return $this->HasMany(CaractHero::class);
    }
}
