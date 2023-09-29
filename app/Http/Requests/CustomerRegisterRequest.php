<?php

namespace App\Http\Requests;

use App\Rules\CustomerFieldsRule;
use Illuminate\Foundation\Http\FormRequest;

class CustomerRegisterRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'full_name' => 'required|max:255|min:4',
            'phone' => ['required', new CustomerFieldsRule()],
            "address" => 'required'
        ];
    }
}
