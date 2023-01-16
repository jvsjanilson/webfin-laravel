<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cidade extends Model
{
    use HasFactory;

    public $fillable = [
        'nome',
        'capital',
        'estado_id',
        'ativo'
    ];

    public function estado()
    {
        return $this->belongsTo(Estado::class);
    }
    
}
