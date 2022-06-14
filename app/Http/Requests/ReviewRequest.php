<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
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
        if($this->method() == 'POST') {
            return [
                'star' => 'required|min:1|max:5',
                'title' => 'required|string',
                'description' => 'required|string'
            ];
        }
        if($this->method() == 'PUT') {
            return [
                'title' => 'sometimes|required|string',
                'description' => 'sometimes|required|string'
            ];
        }
    }
}