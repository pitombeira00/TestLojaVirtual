<?php

namespace App\Services;

use App\Http\Resources\CepResource;
use Illuminate\Support\Facades\Http;

class ViaCepApiService
{

    private $cep;

    public function __construct($cepNumber)
    {

        $this->cep = $cepNumber;

    }

    public function statusCep(){

        $response = $this->getViaCepRequest();

        return $response->ok() && !array_key_exists('erro',$response->json());

    }

    public function dataCreateUser(){

        $response = $this->getViaCepRequest()->json();
        $cep = new CepResource($response);

        return $cep->toArray($response);
    }

    private function getViaCepRequest(){

        return Http::get('viacep.com.br/ws/'.$this->cep.'/json');
    }

    private function streetFieldsUser($response){

        return [
            'state' => $response['uf'],
            'city' => $response['localidade'],
            'neighborhood' => $response['bairro'],
            'street' => $response['logradouro'],
        ];

    }

}
