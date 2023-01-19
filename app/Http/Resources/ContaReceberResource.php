<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ContaReceberResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'documento'     => $this->documento,
            'emissao'       => $this->emissao,
            'vencimento'    => $this->vencimento,
            'valor'         => $this->valor,
            'desconto'      => $this->desconto,
            'juros'         => $this->juros,
            'multa'         => $this->multa,
            'data_pagamento'=> $this->data_pagamento,
            'conta_id'      => $this->conta_id,
            'cliente_id'    => $this->cliente_id,
        ];
    }
}
