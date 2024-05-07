<?php

namespace App\Http\Requests;

use App\Exceptions\CommonValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CuisineRequest extends FormRequest
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

    public function rules(): array
    {
        $routeName = $this->route()->getName();
        switch ($routeName) {
            case 'admin.cuisines.create':
                return $this->saveCuisineRules();
            case 'admin.cuisines.update':
                return $this->updateCuisineRules();
            default:
                return [];
        }
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function saveCuisineRules(){
        return [
            'name' => 'required|string',
            'status' => 'required|in:0,1',
        ];
    }
    public function updateCuisineRules(){
        return [
            'id' => 'required|exists:cuisines,id|string',
            'status' => 'required|in:0,1',
        ];
    }
}
