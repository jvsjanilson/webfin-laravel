<?php

namespace App\Models;

use App\Traits\UserTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fornecedor extends Model
{
    use HasFactory;
    use UserTrait;

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
