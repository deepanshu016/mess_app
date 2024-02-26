<?php

namespace App\Http\Requests;

use App\Exceptions\CommonValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class BannerRequest extends FormRequest
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
            case 'admin.banner.save':
                return $this->saveBannerRules();
            case 'admin.banner.update':
                return $this->updateBannerRules();
            case 'admin.banner.delete':
                return $this->deleteBannerRules();
            default:
                return [];
        }
    }
    public function saveBannerRules(){
        return [
            'title' => 'required',
            'banner_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ];
    }
    public function updateBannerRules(){
        return [
            'id' => 'required|exists:banners,id',
            'title' => 'required',
            'banner_image' => 'image|mimes:jpeg,png,jpg|max:2048',
        ];
    }
    public function deleteBannerRules(){
        return [
            'id' => 'required|exists:banners,id',
        ];
    }
}
