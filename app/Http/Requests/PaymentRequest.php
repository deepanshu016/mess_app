<?php

namespace App\Http\Requests;

use App\Exceptions\CommonValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
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
            case 'mess_owner.payment.request.update':
                return $this->updateCustomersPaymentRules();
            case 'customer.payment.request.create':
                return $this->addPaymentRequestRules();
            default:
                return [];
        }
        return [
            'amount' => 'required',
            'payment_date' => 'required|date',
            'payment_mode' => 'required|in:online,cash',
            'reference_screenshot' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
    public function manageCustomerSubscriptionRules()
    {
        return [
            'amount' => 'required',
            'payment_date' => 'required|date',
            'payment_mode' => 'required|in:online,cash',
            'reference_screenshot' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
    public function updateCustomersPaymentRules()
    {
        return [
            'status' => 'required|in:accept,rejected',
            'notes' => 'required',
        ];
    }
}
