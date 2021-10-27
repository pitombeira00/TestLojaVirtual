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

        return $response->ok();
    }

    public function dataCreateUser(){

        $response = $this->getViaCepRequest()->json();


        return $response;
    }

    private function getViaCepRequest(){

        return Http::get('viacep.com.br/ws/'.$this->dataReturn.'/json');
    }


}
