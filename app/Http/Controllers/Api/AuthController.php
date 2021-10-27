<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRegisterRequest;
use App\Services\ViaCepApiService;
use App\Traits\ApiResponder;
use App\User;

class AuthController extends Controller
{
    use ApiResponder;

    /**
     * Show All User
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {


    }

    /**
     * Show User
     *
     * @param $id
     */
    public function show($id)
    {


    }

    /**
     * Edit User
     */
    public function edit()
    {


    }

    /**
     * Create User
     *
     * @param UserRegisterRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(UserRegisterRequest $request)
    {

        $payload = $request->all();

        $cep = new ViaCepApiService($payload['cep']);

        dd($cep->dataCreateUser());


        return 'ok';
//        $payload['state']
        $user = User::create([
            'name' => $payload['name'],
            'password' => bcrypt($payload['password']),
            'email' => $payload['email'],
            'social_number' => $payload['social_number'],
            'phone' => $payload['phone'],
            'cep' => $payload['cep'],
            'birth' => $payload['birth'],
            'state' => 'pernambuco',
            'city' => 'petrolina',
            'neighborhood' => 'areia branca',
            'street' => 'rua paraiba',
        ]);

        return $this->success([
            'token' => $user->createToken('API Token')->plainTextToken
        ]);
    }



}
