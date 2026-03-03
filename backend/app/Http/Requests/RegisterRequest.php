<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:15',
            'last_name'  => 'required|string|max:15',
            'email'      => 'required|string|email|max:255|unique:users,email',
            'cnic'       => 'required|string|min:13|max:15',
            'gender'     => 'required|string',
            'password'   => [
                'required',
                Password::min(8)
                    ->letters()
                    ->numbers()
                    ->mixedCase()
                    ->symbols(),
                'confirmed',
            ],
        ];
    }

    public function messages(): array
    {
        return [

            // First Name
            'first_name.required' => 'First name is required.',
            'first_name.string'   => 'First name must be a valid string.',
            'first_name.max'      => 'First name must not exceed 15 characters.',

            // Last Name
            'last_name.required' => 'Last name is required.',
            'last_name.string'   => 'Last name must be a valid string.',
            'last_name.max'      => 'Last name must not exceed 15 characters.',

            // Email
            'email.required' => 'Email address is required.',
            'email.email'    => 'Please enter a valid email address.',
            'email.unique'   => 'This email is already registered.',
            'email.max'      => 'Email must not exceed 255 characters.',

            // CNIC
            'cnic.required' => 'CNIC is required.',
            'cnic.min' => 'Not valid CNIC.',
            'cnic.max' => 'Not valid CNIC.',

            // Gender
            'gender.required' => 'Gender is required.',

            // Password
            'password.required'  => 'Password is required.',
            'password.min'       => 'Password must be at least 8 characters.',
            'password.confirmed' => 'Password confirmation does not match.',
        ];
    }
}
