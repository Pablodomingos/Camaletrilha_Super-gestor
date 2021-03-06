<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modelo extends Model
{
    use HasFactory;

    protected $fillable = [
        'marca_id',
        'nome',
        'image',
        'numero_portas',
        'lugares',
        'air_bag',
        'abs'
    ];

    public function marca() {
        //UM modelo pertence a UMA marca
        return $this->belongsTo(Marca::class);
    }
}
