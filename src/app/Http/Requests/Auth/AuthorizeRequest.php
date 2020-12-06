<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class AuthorizeRequest extends FormRequest
{
    public function rules()
    {
        return [
            'token' => ['required', 'string']
        ];
    }

    public function authorize()
    {
        return true;
    }
}
