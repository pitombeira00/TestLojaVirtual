<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\TokenApp;
use App\Traits\ApiResponder;
use App\Http\Requests\TokenGenerateRequest;

class GenerateTokenController extends Controller
{
    use ApiResponder;

    public function register(TokenGenerateRequest $request)
    {

        $payload = $request->all();

        $token = TokenApp::create($payload);

        return $this->success([
            'token' => $token->createToken('API Token')->plainTextToken
        ]);
    }
}
