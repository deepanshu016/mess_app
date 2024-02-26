<?php

namespace App\Http\Requests;

use App\Exceptions\CommonValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class NewsRequest extends FormRequest
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
            case 'admin.news.save':
                return $this->saveNewsRules();
            case 'admin.news.update':
                return $this->updateNewsRules();
            default:
                return [];
        }
    }
    public function saveNewsRules(){
        return [
            'title' => 'required',
            'short_description' => 'required|string|max:250',
            'news_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ];
    }
    public function updateNewsRules(){
        return [
            'id' => 'required|exists:news,id',
            'title' => 'required',
            'short_description' => 'required|string|max:250',
            'news_image' => 'image|mimes:jpeg,png,jpg|max:2048',
        ];
    }
}
