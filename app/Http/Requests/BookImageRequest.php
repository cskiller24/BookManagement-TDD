<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookImageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        if ($this->method() == 'POST') {
            return [
                'image' => 'required|mimes:jpg,png,jpeg|max:10240|file'
            ];
        }
        return [];
    }
}