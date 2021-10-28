<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ViaCepApiService
{

    private $dataReturn;

    public function __construct($cepNumber)
    {

        $this->dataReturn = $cepNumber;

    }

    public function statusCep(){

        $response = $this->getViaCepRequest();

        if(!$response->ok()){

            return false;
        }

        if(array_key_exists('erro',$response->json()))
        {
            return false;
        }

        return true;
    }

    public function dataCreateUser(){

        $response = $this->getViaCepRequest()->json();

        return $this->streetFieldsUser($response);
    }

    private function getViaCepRequest(){

        return Http::get('viacep.com.br/ws/'.$this->dataReturn.'/json');
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
