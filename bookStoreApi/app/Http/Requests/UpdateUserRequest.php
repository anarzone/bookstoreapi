<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
            'name'      => ['required', 'string', 'between: 2, 20'],
            'email'     => ['sometimes', 'email', Rule::unique('users')->ignore($this->user->id)],
            'password'  => ['sometimes', 'min: 6'],
        ];

        return $rules;
    }

    public function messages()
    {
        $messages = [
            'required'  => ':attribute vacib sahədir.',
            'unique'    => ':attribute artıq qeydiyyat keçib.',
            'email'     => ':attribute yalnış formatdadır.',
            'between'   => ':attribute xarakter sayı :min və :max arasında olmalıdır.',
            'min'       => ':attribute xarakter sayı ən az :min olmalıdır.',
        ];

        return $messages;
    }
}
