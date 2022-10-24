<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSkuRequest extends FormRequest
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
            'selectedVariants' => 'required|array',
            'selectedVariants.*.price' => 'required|numeric|min:0',
            'selectedVariants.*.quantity' => 'required|numeric|min:0',
            'selectedVariants.*.variants' => 'required|array',
            'selectedVariants.*.variants.*.value' => 'required|exists:App\Models\Variant,id',
            'selectedVariants.*.variants.*.name' => 'required|string',
        ];
    }
}
