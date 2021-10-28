<?php

namespace App\Http\Requests;

use App\Rules\CepExists;
use Illuminate\Foundation\Http\FormRequest;

class UserEditRequest extends FormRequest
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
            'name' => 'string|max:255',
            'password' => 'string|min:6|confirmed',
            'birth' => 'string',
            'phone' => 'string|max:11',
            'cep' => ['string','max:11', new CepExists],
        ];
    }
}
