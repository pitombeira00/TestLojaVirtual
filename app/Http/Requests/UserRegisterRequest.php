<?php

namespace App\Http\Requests;

use App\Rules\CepExists;
use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'birth' => 'required|string',
            'phone' => 'required|string|max:11',
            'social_number' => 'required|numeric|digits:11|unique:users,social_number',
            'cep' => ['required','numeric','digits:8', new CepExists],
        ];
    }
}
