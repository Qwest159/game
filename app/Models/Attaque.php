<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attaque extends Model
{
    /** @use HasFactory<\Database\Factories\AttaqueFactory> */
    use HasFactory;
    public function role()
    {
        return $this->belongsTo(Role::class);
    }


    public function users()
    {
        return $this->belongsToMany(User::class, 'attaque_users', 'attaque_id', 'user_id');
    }
}
