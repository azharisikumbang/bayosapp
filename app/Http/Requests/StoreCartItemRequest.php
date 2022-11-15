<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCartItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'product' => 'required|exists:App\Models\Product,id',
            'variants' => 'required|array',
            'variants.*.id' => 'required|exists:App\Models\Variant,id',
            'quantity' => 'required|numeric|min:1'
        ];
    }
}
