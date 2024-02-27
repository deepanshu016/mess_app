<?php

namespace App\Http\Requests;

use App\Exceptions\CommonValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class GalleryRequest extends FormRequest
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
            case 'mess_owner.gallery.save':
                return $this->saveGalleryRules();
            case 'mess_owner.gallery.update':
                return $this->updateGalleryRules();
            case 'mess_owner.gallery.delete':
                return $this->deleteGalleryRules();
            case 'delete.media':
                return $this->deleteMediaRules();
            default:
                return [];
        }
    }
    public function saveGalleryRules(){
        return [
            'title' => 'required',
            'medias' => 'required|array',
            'medias.*' => 'mimes:jpeg,png,jpg,gif,mp4,avi,mov',
        ];
    }
    public function updateGalleryRules(){
        return [
            'id' => 'required|exists:galleries,id',
            'title' => 'required',
            'medias' => 'array',
            'medias.*' => 'mimes:jpeg,png,jpg,gif,mp4,avi,mov',
        ];
    }
    public function deleteGalleryRules(){
        return [
            'id' => 'required|exists:galleries,id',
        ];
    }
    public function deleteMediaRules(){
        return [
            'id' => 'required|exists:media,id',
        ];
    }
}
