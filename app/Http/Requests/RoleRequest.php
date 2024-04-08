<?php

namespace App\Http\Requests;

use App\Exceptions\CommonValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RoleRequest extends FormRequest
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
            case 'admin.role.save':
                return $this->saveRoleRules();
            case 'admin.role.update':
                return $this->updateRoleRules();
            case 'admin.role.permission.update':
                return $this->updateRolePermissionRules();
            default:
                return [];
        }
    }
    public function saveRoleRules(){
        return [
            'name' => 'required',
        ];
    }
    public function updateRoleRules(){
        return [
            'id' => 'required|exists:roles,id',
            'name' => 'required',
        ];
    }
    public function updateRolePermissionRules(){
        return [
            'id' => 'required|exists:roles,id',
            'permission' => 'required',
        ];
    }
}
