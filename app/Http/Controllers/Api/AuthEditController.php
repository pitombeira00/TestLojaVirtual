<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserEditRequest;
use App\Services\ViaCepApiService;
use App\Traits\ApiResponder;
use App\User;
use Illuminate\Http\Request;

class AuthEditController extends Controller
{
    use ApiResponder;

    private $dataEditUser = [];
    private $fieldsRequestUser;

    private $fieldsToEdit = ['name', 'password','birth','phone','cep'];
    private $fieldsStreet = ['state','city','neighborhood', 'street'];

    public function __invoke($id,UserEditRequest $request)
    {

        return $this->existField(User::find($id),$request);

    }

    private function existField($user,$request){

        if($user){

            $this->fieldsRequestUser = $request->all();

            $this->checkFieldsUser();

            $this->editUser($user);

            $editUser = User::find($user->id);
            return $this->success([
                'user' => $editUser,
            ], 'Edit Success');

        }

        return $this->error([
            'user' => $user,
        ], 'User Not Found');
    }


    private function checkFieldsUser(){

        foreach($this->fieldsToEdit as $field){

            if(array_key_exists($field,$this->fieldsRequestUser)){
                $this->dataEditUser[$field] = $this->fieldsRequestUser[$field];

                if($field === 'cep'){

                    $cep = new ViaCepApiService($this->fieldsRequestUser['cep']);

                    $this->dataEditUser += $cep->dataCreateUser();

                }

            }
        }
    }

    private function editUser($user){

        $editado = User::where('id',$user->id)->update($this->dataEditUser);

    }
}
