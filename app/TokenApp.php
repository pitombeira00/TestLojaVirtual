<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class TokenApp extends Authenticatable
{

    use HasApiTokens;

    protected $table = 'token_app';

    protected $fillable = [
        'name'
    ];



}
