<?php

namespace App\Rules;

use App\Services\ViaCepApiService;
use Illuminate\Contracts\Validation\Rule;

class CepExists implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {

        $cep = new ViaCepApiService($value);

        return $cep->statusCep();

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Cep invalido.';
    }
}
