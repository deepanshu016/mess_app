<?php

namespace App\Http\Requests;
use App\Exceptions\CommonValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
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
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required',
            'level_type' => 'required|in:country,state,city',
            'user_image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ];
        if ($this->input('level_type') === 'country') {
            $rules['country_id'] = 'required|array|exists:countries,id';
        } else {
            $rules['country_id'] = 'required|integer|exists:countries,id';
        }
        if ($this->input('level_type') === 'state') {
            $rules['state_id'] = 'required|array|exists:states,id';
        } else {
            $rules['state_id'] = 'required|integer|exists:states,id';
        }
        if ($this->input('level_type') === 'city') {
            $rules['city_id'] = 'required|array|exists:cities,id';
        } else {
            $rules['city_id'] = 'required|integer|exists:cities,id';
        }
        return $rules;
    }
    public function updateUsersRules(){
        return [
            'id' => 'required|exists:users,id',
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'user_image' => 'image|mimes:jpeg,png,jpg|max:2048',
        ];
    }




    // public function deleteBannerRules(){
    //     return [
    //         'id' => 'required|exists:banners,id',
    //     ];
    // }
}
