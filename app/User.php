<?php

namespace App;

use App\Services\ViaCepApiService;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens,Notifiable;

    const fieldsEdit = ['name', 'email','password','birth','phone','cep'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','birth','phone','social_number','cep'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function editUser($request){

        foreach(self::fieldsEdit as $field){

            if(array_key_exists($field,$request)){

                $this->setAttribute($field,$request[$field]);

                if($field === 'cep'){

                    $cep = new ViaCepApiService($request['cep']);

                    $dataCep = $cep->dataCreateUser();

                    $this->setAttribute('state',$dataCep['state']);
                    $this->setAttribute('neighborhood',$dataCep['neighborhood']);
                    $this->setAttribute('street',$dataCep['street']);
                    $this->setAttribute('city',$dataCep['city']);

                }

            }
        }

        $this->save();
    }
}
