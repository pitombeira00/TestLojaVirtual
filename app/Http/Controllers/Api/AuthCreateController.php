<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRegisterRequest;
use App\Services\ViaCepApiService;
use App\Traits\ApiResponder;
use App\User;

class AuthCreateController extends Controller
{
    use ApiResponder;

    public function __invoke(UserRegisterRequest $request)
    {
        $payload = $request->all();

        $cep = new ViaCepApiService($payload['cep']);

        $fieldsUser = array_merge($payload,$cep->dataCreateUser());

        $createUser = User::create($fieldsUser);

        return $this->success([
            'user' => $createUser
        ],'User Create Success');
    }
}
