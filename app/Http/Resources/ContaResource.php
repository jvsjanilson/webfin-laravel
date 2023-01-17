<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ContaResource extends JsonResource
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
            'id'                => $this->id,
            'numero_banco'      => $this->numero_banco,
            'numero_agencia'    => $this->numero_agencia,
            'numero_conta'      => $this->numero_conta,
            'descricao'         => $this->descricao,
            'tipo_conta'        => $this->tipo_conta,
            'data_abertura'     => $this->data_abertura,
            'saldo'             => $this->saldo,
            'ativo'             => $this->ativo,
        ];
    }
}
