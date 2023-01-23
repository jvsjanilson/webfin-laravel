<?php

namespace App\Models;

use App\Traits\UserTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conta extends Model
{
    use HasFactory;
    use UserTrait;

    public $fillable = [
        'numero_banco',
        'numero_agencia',
        'numero_conta',
        'descricao',
        'tipo_conta',
        'data_abertura',
        'saldo',
        'user_id',
        'ativo'
    ];
}
