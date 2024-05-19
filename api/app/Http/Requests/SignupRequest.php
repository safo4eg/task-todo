<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class SignupRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'username' => ['required', 'string','min:6', 'max:32', 'unique:users'],
            'password' => ['required', 'string', 'confirmed', Password::min(8)
                ->max(255)
                ->mixedCase()
                ->numbers()
            ],
            'password_confirmation' => ['required']
        ];
    }
}
