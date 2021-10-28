<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserEditRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Services\ViaCepApiService;
use App\Traits\ApiResponder;
use App\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use ApiResponder;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $users = User::All();

        return $this->success([
            'users' => $users,
        ], 'All Users');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserRegisterRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(UserRegisterRequest $request)
    {
        $payload = $request->all();

        $cep = new ViaCepApiService($payload['cep']);

        $fieldsUser = $cep->dataCreateUser();

        $createUser = new User($payload);

        $createUser->state = $fieldsUser['state'];
        $createUser->city = $fieldsUser['city'];
        $createUser->neighborhood = $fieldsUser['neighborhood'];
        $createUser->street = $fieldsUser['street'];

        $createUser->save();


        return $this->success([
            'user' => $createUser
        ],'User Create Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $user = User::find($id);
        if($user){

            return $this->success([
                'user' => $user,
            ], 'user');

        }

        return $this->error([
            'user' => $user,
        ], 'User Not Found');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UserEditRequest $request, $id)
    {
        $user = User::find($id);

        if($user){

            $user->editUser($request->all());

            return $this->success([
                'user' => $user,
            ], 'Edit Success');

        }

        return $this->error([
            'user' => $user,
        ], 'User Not Found');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        if(User::destroy($id)){

            return $this->success(null, 'User Delete Success');

        }

        return $this->error(null, 'User Not Found');
    }

    private function existField($user,$request){


    }


}
