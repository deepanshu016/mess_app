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
        $routeName = $this->route()->getName();
        switch ($routeName) {
            case 'mess_owner.customer.save.subscription':
                return $this->manageCustomerSubscriptionRules();
            case 'mess_owner.customer.save':
                return $this->addCustomerRules();
            case 'mess_owner.customer.mark.attendance':
                return $this->markAttendanceRules();
            default:
                return [];
        }
    }
    public function manageCustomerSubscriptionRules(){
        return [
            'subscription_start' =>'required|date',
            'payment_mode'=>'required'
        ];
    }
    public function markAttendanceRules(){
        return [
            'attendance_start' =>'required|date'
        ];
    }
    public function addCustomerRules(){
        return [
            'name' =>'required',
            'email'=>'required|email|unique:users,email,except,id',
            'phone'=>'required|numeric|unique:users,phone,except,id',
            'email'=>'required|email|unique:users,email,except,id',
            'food_type' => ['required',Rule::in(['veg', 'non_veg'])],
            'meal_time' => 'required|array',
            'meal_time.*' => 'in:breakfast,lunch,dinner',
            'password' => 'required',
            'payment' => 'required'
        ];
    }
}
