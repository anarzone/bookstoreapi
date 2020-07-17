<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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

        $rules = [
            'name'      => 'required|between: 2, 20',
            'email'     => 'required|email|unique:users',
        ];

        if($this->request->has('password')){
            $rules['password'] = 'required|min: 6';
        }

        return $rules;
    }

    public function messages()
    {
        $messages = [
            'required'  => ':attribute vacib sahədir.',
            'unique'    => ':attribute artıq qeydiyyat keçib.',
            'email'     => ':attribute yalnış formadadır.',
            'between'   => ':attribute xarakter sayı :min və :max arasında olmalıdır.',
        ];

        return $messages;
    }
}
