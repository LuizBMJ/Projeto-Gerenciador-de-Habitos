<?php

namespace App\Http\Requests;

// This handles validation for habit form data

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class HabitRequest extends FormRequest
{
    // Allow anyone to make this request (authorization is handled in the controller)
    public function authorize(): bool
    {
        return true;
    }

    // Validation rules for the habit form
    public function rules(): array
    {
        $habitId = $this->route('habit')?->id;

        return [
            'name' => [
                'required',
                'string',
                'max:255',
                // Name must be unique for this user
                Rule::unique('habits')
                    ->where(fn ($query) => $query->where('user_id', Auth::id()))
                    ->ignore($habitId),
            ],
        ];
    }

    // Custom error messages
    public function messages(): array
    {
        return [
            'name.required' => 'O campo de nome é obrigatorio.',
            'name.string' => 'O campo de nome deve ser um texto.',
            'name.max' => 'O campo de nome não pode ter mais de 255 caracteres.',
            'name.unique' => 'Você já possui um hábito com esse nome.',
        ];
    }
}
