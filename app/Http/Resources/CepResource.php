<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CepResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'state' => $request['uf'],
            'city' => $request['localidade'],
            'neighborhood' => $request['bairro'],
            'street' => $request['logradouro'],
        ];
    }
}
