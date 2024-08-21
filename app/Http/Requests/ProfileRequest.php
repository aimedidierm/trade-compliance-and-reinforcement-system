<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            "current_password" => "required|string",
            "password" => "required|string",
            "confirm_password" => [
                "required",
                "string",
                function ($attribute, $value, $fail) {
                    if ($value !== request('password')) {
                        $fail('The confirm password must match the new password.');
                    }
                },
            ],
        ];
    }
}
