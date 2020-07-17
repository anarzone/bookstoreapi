<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAuthorRequest extends FormRequest
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
            'firstname' => 'required|string|between: 2, 20',
            'lastname'  => 'required|string|between: 2, 40',
        ];
    }

    public function messages()
    {
        return [
            'required'  => ':attribute tələb olunan sahədir',
            'string'    => ':attribute tipi string olmalıdır',
            'between'    => ':attribute xarakter sayı :min və :max arasında olmalıdır',
        ];
    }
}
