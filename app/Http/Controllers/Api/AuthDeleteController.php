<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponder;
use App\User;

class AuthDeleteController extends Controller
{
    use ApiResponder;

    public function __invoke($id)
    {

       return $this->deleteUser(User::destroy($id));

    }

    private function deleteUser($user){

        if($user){

            return $this->success(null, 'User Delete Success');

        }

        return $this->error(null, 'User Not Found');
    }
}
