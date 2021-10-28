<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponder;
use App\User;

class AuthIndexController extends Controller
{
    use ApiResponder;

    public function __invoke()
    {

        $users = User::All();

        return $this->success([
            'users' => $users,
        ], 'All Users');
    }


}
