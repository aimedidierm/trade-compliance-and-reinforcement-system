<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShipmentRequest extends FormRequest
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
            'sale' => 'required|exists:sales,id',
            'packaging_number' => 'required|string|max:255',
            'courier' => 'required|string|max:255',
            'ship_via' => 'required|string|max:255',
            'date' => 'required|date',
            'address' => 'required|string|max:255',
            'tracking' => 'required|string|max:255|unique:shipments,tracking_number',
        ];
    }
}
