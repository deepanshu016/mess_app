<?php

namespace App\Http\Requests;

use App\Exceptions\CommonValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class AddCustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
    public function failedValidation(Validator $validator){
        throw new CommonValidationException($validator);
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' =>'required',
            'email'=>'required|email|unique:users,email,except,id',
            'phone'=>'required|numeric|unique:users,phone,except,id',
            'email'=>'required|email|unique:users,email,except,id',
            'password' => 'required',
            'food_type' => ['required',Rule::in(['veg', 'non_veg'])],
            'meal_time' => 'required|array',
            'meal_time.*' => 'in:breakfast,lunch,dinner',
            'payment_status' => ['required',Rule::in(['paid', 'unpaid'])],
            'payment_date' => 'required_if:payment_status,paid|date',
            'payment_screenshot' => 'required_if:payment_status,paidimage|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
}
