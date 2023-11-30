<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SignInRequest extends FormRequest
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
            'email' => [
                'required',
                'email',
                Rule::exists('users')->where(
                    function ($query) {
                        $query->where('email', $this->input('email'));
                    }
                ),
            ],
            'password' => [
                'required',
                'min:6',
                'max:30',
                'regex:/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,30}$/',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Email does not blank',
            'email.exists' => 'Email does not exist.',
            'password.required' => 'Password cannot be blank.',
            'password.min' => 'Passwords must be at least 6 characters.',
            'password.max' => 'Password must not exceed 30 characters.',
            'password.regex' => 'Password must contain at least one letter and one number.',
        ];
    }
}
