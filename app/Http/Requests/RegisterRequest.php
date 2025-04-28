<?php

namespace App\Http\Requests;

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
            'username' => 'required|string|max:255',
            'phone' => 'required|string|min:7|max:20',
        ];
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [
            'username.required' => 'The username is required.',
            'phone.required' => 'The phone number is required.',
            'phone.integer' => 'The phone number must be a valid number.',
        ];
    }
}
