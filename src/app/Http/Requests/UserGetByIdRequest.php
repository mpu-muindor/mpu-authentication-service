<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserGetByIdRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'id' => 'required|uuid'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
