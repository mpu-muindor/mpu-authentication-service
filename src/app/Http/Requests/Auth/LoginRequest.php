<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function rules()
    {
        return [
            'login' => ['required_without:email', 'string'],
            'email' => ['required_without:login', 'email'],
            'password' => ['required', 'string']
        ];
    }

    public function authorize()
    {
        return true;
    }
}
