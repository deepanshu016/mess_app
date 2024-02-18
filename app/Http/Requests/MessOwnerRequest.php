<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Exceptions\CommonValidationException;
use Illuminate\Contracts\Validation\Validator;

class MessOwnerRequest extends FormRequest
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
    public function rules()
    {
        return [
            'mess_name' => 'required',
            'mess_owner_name' => 'required',
            'email' => 'required|email|unique:users,email,except,id',
            'phone' => 'required|numeric',
            'password' => 'required',
            'mess_logo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'mess_banner' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'food_type' => 'required|in:veg,non_veg,both',
            'veg_breakfast_price' => 'required_if:food_type,veg,both',
            'veg_lunch_price' => 'required_if:food_type,veg,both',
            'veg_dinner_price' => 'required_if:food_type,veg,both',
            'non_veg_breakfast_price' => 'required_if:food_type,non_veg,both',
            'non_veg_lunch_price' => 'required_if:food_type,non_veg,both',
            'non_veg_dinner_price' => 'required_if:food_type,non_veg,both'
        ];
    }
}
