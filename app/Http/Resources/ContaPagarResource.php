<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ContaPagarResource extends JsonResource
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
            'valor'         => (float)$this->valor,
            'desconto'      => (float)$this->desconto,
            'juros'         => (float)$this->juros,
            'multa'         => (float)$this->multa,
            'total_pago'    => !is_null($this->data_pagamento) ? ($this->valor + $this->juros + $this->multa - $this->desconto) : 0,
            'data_pagamento'=> $this->data_pagamento,
            'conta_id'      => $this->conta_id,
            'fornecedor_id' => $this->fornecedor_id,
            'fornecedor' => [
               'nome' => $this->fornecedor->nome,
               'cpfcnpj' => $this->fornecedor->cpfcnpj,
               'celular' => $this->fornecedor->celular,

            ]
        ];
    }
}
