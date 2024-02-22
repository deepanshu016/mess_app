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
            case 'mess_owner.customer.filter.attendance':
                return $this->filterAttendanceRules();
            default:
                return [];
        }
    }
    public function manageCustomerSubscriptionRules(){
        return [
            'refill_amount' =>'required',
        ];
    }
    public function markAttendanceRules(){
        return [
            'attendance_start' =>'required|date',
            'meal_time' => 'required|array',
            'meal_time.*' => 'in:breakfast,lunch,dinner',
        ];
    }
    public function addCustomerRules(){
        return [
            'name' =>'required',
            'email'=>'required|email|unique:users,email,except,id',
            'phone'=>'required|numeric|unique:users,phone,except,id',
            'email'=>'required|email|unique:users,email,except,id',
            'password' => 'required',
            'payment' => 'required',
            'food_type' => 'required|in:veg,non_veg',
            'subscription_starts_at' => 'required|date'
        ];
    }
    public function filterAttendanceRules(){
        return [
            'customer_id'=>'required',
            'month'=>'required'
        ];
    }
}
