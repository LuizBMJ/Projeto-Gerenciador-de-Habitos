<?php

namespace App\Http\Requests;

// This handles validation for registration form data

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    // Allow anyone to make this request
    public function authorize(): bool
    {
        return true;
    }

    // Validation rules for the registration form
    public function rules(): array
    {
        return [
            'name' => 'required|min:3|max:255|string',
            'email' => 'required|email|unique:users,email',
            'password' => [
                'required',
                'min:8',
                'max:60',
                'confirmed',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*#?&]/',
            ],
        ];
    }

    // Custom error messages
    public function messages(): array
    {
        return [
            'name.required' => 'O campo de nome é obrigatorio.',
            'name.min' => 'O campo de nome deve ter pelo menos 3 caracteres.',
            'name.max' => 'O campo de nome deve ter no máximo 255 caracteres.',
            'name.string' => 'O campo de nome deve ser um texto.',

            'email.required' => 'O campo de email é obrigatorio.',
            'email.email' => 'Por favor entre com um email valido.',
            'email.unique' => 'Este email já está em uso.',

            'password.required' => 'O campo de senha é obrigatorio.',
            'password.min' => 'O campo de senha deve ter pelo menos 8 caracteres.',
            'password.max' => 'O campo de senha deve ter no máximo 60 caracteres.',
            'password.confirmed' => 'As senhas não coincidem.',
            'password.regex' => 'A senha deve conter letras maiúsculas, números e caracteres especiais.',
        ];
    }
}
