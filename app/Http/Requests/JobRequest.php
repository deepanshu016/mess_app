<?php

namespace App\Http\Requests;

use App\Exceptions\CommonValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class JobRequest extends FormRequest
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
            case 'admin.job.save':
                return $this->saveJobRules();
            case 'admin.job.update':
                return $this->updateJobRules();
            case 'admin.job.delete':
                return $this->deleteJobRules();
            case 'apply.job':
                return $this->applyJobRules();
            default:
                return [];
        }
    }
    public function saveJobRules(){
        return [
            'title' => 'required',
            'vacant_seat' => 'required',
            'description' => 'required'
        ];
    }
    public function applyJobRules(){
        return [
            'name' => 'required',
            'phone' => 'required|integer',
            'email' => 'required|email',
            'about' => 'required'
        ];
    }
    public function updateJobRules(){
        return [
            'title' => 'required',
            'vacant_seat' => 'required',
            'description' => 'required'
        ];
    }
    public function deleteJobRules(){
        return [
            'id' => 'required|exists:jobs,id',
        ];
    }
}
