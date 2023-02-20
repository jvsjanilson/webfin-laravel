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
        'conta_id',
        'cliente_id',
        'user_id',
        
    ];

    /**
     * Relacionamentos
     */

    public function conta()
    {
        return $this->belongsTo(Conta::class);
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}
