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
            'total_pago'    => !is_null($this->data_pagamento) ? ($this->valor + $this->juros + $this->multa - $this->desconto) : 0,
            // 'total_pago'    => $this->when(!is_null($this->data_pagamento), $this->valor + $this->juros + $this->multa - $this->desconto),
            'conta_id'      => $this->conta_id,
            'cliente_id'    => $this->cliente_id,
            'cliente'       => [
               'nome' => $this->cliente->nome,
               'cpfcnpj' => $this->cliente->cpfcnpj,
               'celular' => $this->cliente->celular,

            ]
        ];
    }
}
