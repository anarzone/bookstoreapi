<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
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
            'firstname' => 'required|min: 2,20',
            'lastname'  => 'nullable|min: 2',
            'email'     => 'required|email',
            'password'  => 'required|min: 6',
        ];

        return $rules;
    }

    public function messages()
    {
        $messages = [
            'required'  => ':attribute vacib sahədir.',
            'unique'    => ':attribute artıq qeydiyyat keçib.',
            'email'     => ':attribute yalnış formadadır.',
            'between'   => ':attribute xarakter sayı :min və :max arasında olmalıdır.',
            'min'       => ':attribute xarakter sayı ən az :min olmalıdır.',
        ];

        return $messages;
    }
}


