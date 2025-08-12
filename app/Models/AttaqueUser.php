<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttaqueUser extends Model
{
    /** @use HasFactory<\Database\Factories\AttaqueUserFactory> */
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function attaque()
    {
        return $this->belongsTo(Attaque::class);
    }
}
