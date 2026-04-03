<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class HabitRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $habitId = $this->route('habit')?->id;

        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('habits')
                    ->where(fn($query) => $query->where('user_id', Auth::id()))
                    ->ignore($habitId),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O campo nome é obrigatório.',
            'name.string'   => 'Deve ser um texto.',
            'name.max'      => 'O campo nome não pode ter mais de 255 caracteres.',
            'name.unique'   => 'Você já possui um hábito com esse nome.',
        ];
    }
}