<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    public $fillable = [
        'nome',
        'nome_fantasia',
        'cpfcnpj',
        'logradouro',
        'numero',
        'cep',
        'complemento',
        'bairro',
        'estado_id',
        'cidade_id',
        'fone',
        'celular',
        'email',
        'user_id',
        'ativo'
    ];

    /**
     * Relacionamentos
     */
    public function estado()
    {
        return $this->belongsTo(Estado::class);
    }

    public function cidade()
    {
        return $this->belongsTo(Cidade::class);
    }

}
