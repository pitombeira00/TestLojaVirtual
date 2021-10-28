<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponder;
use App\User;

class AuthShowController extends Controller
{
    use ApiResponder;

   public function __invoke($id)
   {

       return $this->validateUser(User::find($id));

   }

   private function validateUser($user){

       if($user){

           return $this->success([
               'user' => $user,
           ], 'user');

       }

       return $this->error([
           'user' => $user,
       ], 'User Not Found');
   }
}
