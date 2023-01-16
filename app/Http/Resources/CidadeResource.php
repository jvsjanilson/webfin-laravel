<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;


class CidadeResource extends JsonResource
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
            'id'        => $this->id,
            'nome'      => $this->nome,
            'capital'   => $this->capital,
            'estado_id' => $this->estado_id,
            'uf'        => $this->estado->uf,
            'ativo'     => $this->ativo,

        ];
    }


}
