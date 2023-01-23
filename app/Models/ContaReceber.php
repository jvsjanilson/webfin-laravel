<?php

namespace App\Models;

use App\Traits\UserTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContaReceber extends Model
{
    use HasFactory;
    use UserTrait;

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
