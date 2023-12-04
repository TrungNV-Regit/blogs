<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

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
            'username_or_email' => [
                'required',
                function ($attribute, $value, $fail) {
                    $user = User::where('email', $value)->orWhere('username', $value)->first();
                    if (!$user) {
                        $fail(trans('message.username_or_email_not_found'));
                    }
                }
            ],
            'password' => [
                'required',
                'regex:/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,30}$/',
            ],
        ];
    }
}
