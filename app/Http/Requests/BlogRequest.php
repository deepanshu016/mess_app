<?php

namespace App\Http\Requests;

use App\Exceptions\CommonValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BlogRequest extends FormRequest
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
                return $this->saveBlogRules();
            case 'admin.job.update':
                return $this->updateBlogRules();
            case 'admin.job.delete':
                return $this->deleteBlogRules();
            default:
                return [];
        }
    }
    public function saveBlogRules(){
        return [
            'title' => 'required',
            'blog_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'description' => 'required'
        ];
    }
    public function updateBlogRules(){
        return [
            'title' => 'required',
            'blog_image' => 'image|mimes:jpeg,png,jpg|max:2048',
            'description' => 'required'
        ];
    }
    public function deleteBlogRules(){
        return [
            'id' => 'required|exists:jobs,id',
        ];
    }
}
