<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'phone' => [
                'required',
                'string',
                'min:10',
                'max:10',
                'regex:/^(091|092|093|094)\d{7}$/',
                'unique:customers,phone',
            ],
            'backup_phone' => [
                'nullable',
                'string',
                'min:10',
                'max:10',
                'regex:/^(091|092|093|094)\d{7}$/',
                'unique:customers,backup_phone',
            ],
            'first_name'   => 'required|string|max:255',
            'middle_name'  => 'nullable|string|max:255',
            'last_name'    => 'required|string|max:255',
            'email'        => 'nullable|email|unique:customers,email',
            'password'     => 'required|string|min:8|confirmed',
        ];
    }
}
