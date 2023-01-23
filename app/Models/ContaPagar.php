<?php

namespace App\Models;

use App\Traits\UserTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContaPagar extends Model
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
        'fornecedor_id',
        'user_id',
    ];
}
