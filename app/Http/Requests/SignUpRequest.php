<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class SignUpRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    
    public function rules(): array
    {
        return [
            'username' => 'required|min:6',
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email'),
            ],
            'password' => [
                'required',
                'min:6',
                'max:30',
                'regex:/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,30}$/',
            ],
            'passwordConfirm' => [
                'required',
                'min:6',
                'max:30',
                'same:password',
            ],
        ];
    }
}
