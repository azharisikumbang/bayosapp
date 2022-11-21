<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserSettingRequest extends FormRequest
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
            'name' => 'required|string',
            'email' => [
                'required', 
                'email', 
                Rule::unique(User::class, 'email')->ignore($this->user()->id)
            ],
            'dob' => 'required|date',
            'gender' => 'required',
            'phone' => 'required|string',
            'address' => 'required|string',
            'picture' => 'sometimes|required|image',
        ];
    }
}
