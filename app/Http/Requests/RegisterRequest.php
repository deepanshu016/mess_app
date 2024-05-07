<?php

namespace App\Http\Requests;

use App\Exceptions\CommonValidationException;
use Illuminate\Contracts\Validation\Validator;
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
    public function failedValidation(Validator $validator){
        throw new CommonValidationException($validator);
    }
    public function rules(): array
    {
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,except,id',
            'phone' => 'required|numeric|unique:users,phone',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
            'mess_id' => 'required_if:signup_type,customer',
            'cuisine_id.*' => 'required_if:signup_type,mess_owner',
            'terms_condition' => 'required'
        ];
    }
}
