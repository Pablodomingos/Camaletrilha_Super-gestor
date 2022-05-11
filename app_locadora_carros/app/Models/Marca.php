<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'image'
    ];

    public function modelos() {
        //UMA marca POSSUI MUITOS modelos
        return $this->hasMany(Modelo::class);
    }
}
