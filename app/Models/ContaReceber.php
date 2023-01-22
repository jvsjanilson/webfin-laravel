<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContaReceber extends Model
{
    use HasFactory;

    public $fillable = [
        'documento',
        'emissao',
        'vencimento',
        'valor',
        'desconto',
        'juros',
        'multa',
        'data_pagamento',
        'conta_id',
        'cliente_id',
        'user_id',
    ];
}
