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
        'conta_id',
        'fornecedor_id',
        'user_id',
    ];

    /**
     * Relacionamentos
     */

    public function conta()
    {
        return $this->belongsTo(Conta::class);
    }

    public function fornecedor()
    {
        return $this->belongsTo(Fornecedor::class);
    }

}
