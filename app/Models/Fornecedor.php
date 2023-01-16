<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fornecedor extends Model
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
        'ativo'
    ];
}
