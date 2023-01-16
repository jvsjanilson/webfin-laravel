<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClienteResource extends JsonResource
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
            'nome' => $this->nome,
            'nome_fantasia' => $this->nome_fantasia,
            'cpfcnpj' => $this->cpfcnpj,
            'logradouro' => $this->logradouro,
            'numero' => $this->numero,
            'cep' => $this->cep,
            'complemento' => $this->complemento,
            'bairro' => $this->bairro,
            'estado_id' => $this->estado_id,
            'cidade_id' => $this->cidade_id,
            'fone' => $this->fone,
            'celular' => $this->celular,
            'email' => $this->email,
            'ativo' => $this->ativo,
        ];
    }
}
