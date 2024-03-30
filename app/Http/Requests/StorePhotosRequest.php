<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\MaxPhotosRule;

class StorePhotosRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        //add db validation fo 10 photos
        return [
            'title' => 'required|max:255',
            'photos' => ['required', new MaxPhotosRule],
            'photos.*' => ['image','mimetypes:image/jpeg,image/png,image/jpg','mimes:jpg,jpeg,png','max:2048'],
        ];
    }
    public function attributes(): array
    {
        return [
            'photos.*' => 'photo',
        ];
    }

    public function messages(): array
    {
        return [
            'photos.*.max' => 'Each :attribute must not be greater than 2 MB.',
        ];
    }
}
