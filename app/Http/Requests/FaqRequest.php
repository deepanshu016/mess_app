<?php

namespace App\Http\Requests;

use App\Exceptions\CommonValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class FaqRequest extends FormRequest
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
            case 'admin.faq.save':
                return $this->saveFaqRules();
            case 'admin.faq.update':
                return $this->updateFaqRules();
            case 'admin.faq.delete':
                return $this->deleteFaqRules();
            default:
                return [];
        }
    }
    public function saveFaqRules(){
        return [
            'question' => 'required',
            'answer' => 'required',
        ];
    }
    public function updateFaqRules(){
        return [
            'id' => 'required|exists:faqs,id',
            'question' => 'required',
            'answer' => 'required',
        ];
    }
    public function deleteFaqRules(){
        return [
            'id' => 'required|exists:faqs,id',
        ];
    }
}
