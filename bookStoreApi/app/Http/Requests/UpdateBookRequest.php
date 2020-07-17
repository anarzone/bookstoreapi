<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\Rule;

class UpdateBookRequest extends FormRequest
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
        $book_id = (int)Request::segments()[4];
        return [
            'title' => "unique:book_translations,title,{$book_id},book_id",
            'description' => 'required|min: 5',
            'isbn' => 'sometimes|string',
            'amount' => 'sometimes|numeric',
            'price' => 'sometimes|numeric|between:0, 9999.99',
        ];
    }

    public function messages()
    {
        return [
            'required'  => ':attribute vacib sahədir.',
            'between'   => ':attribute xarakter sayı :min və :max arasında olmalıdır.',
            'string'    => ':attribute xarakter tipi string deyil.',
            'numeric'   => ':attribute xarakter tipi rəqəm olmalıdır.',
            'min'       => ':attribute ən az :min xarakterdən ibarət olmalıdır.',
            'unique'    => ':attribute artıq yaradılıb.',
        ];
    }
}
