<?php

namespace App\Http\Requests;
use App\Exceptions\CommonValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
            case 'admin.users.save':
                return $this->saveUsersRules();
            case 'admin.users.update':
                return $this->updateUsersRules();
            default:
                return [];
        }
    }
    public function saveUsersRules(){
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users,columns',
            'phone' => 'required',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required',
            'level_type' => 'required|in:country,state,city',
            'user_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ];
    }
    public function updateBannerRules(){
        return [
            'id' => 'required|exists:banners,id',
            'name' => 'required',
            'email' => 'required|email|unique:users,columns',
            'phone' => 'required',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required',
            'level_type' => 'required|in:country,state,city',
            'user_image' => 'image|mimes:jpeg,png,jpg|max:2048',
        ];
    }
    // public function deleteBannerRules(){
    //     return [
    //         'id' => 'required|exists:banners,id',
    //     ];
    // }
}
