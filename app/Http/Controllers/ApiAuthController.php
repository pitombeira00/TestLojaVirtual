<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRegisterRequest;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class ApiAuthController extends Controller
{
    use ApiResponser;

    public function register(UserRegisterRequest $request)
    {

        $payload = $request->all();

//        $user = User::create([
//            'name' => $attr['name'],
//            'password' => bcrypt($attr['password']),
//            'email' => $attr['email']
//        ]);

        return $this->success([
            'token' => $payload
        ]);
    }
}
