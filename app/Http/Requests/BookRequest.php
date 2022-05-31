<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
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
                'genre_id' => 'required|exists:genres,id',
                'title' => 'required|string',
                'description' => 'sometimes|required|string',
            ];
        }
        if ($this->method() == 'PUT') {
            return [
                'genre_id' => 'sometimes|required|exists:genres,id',
                'title' => 'sometimes|required|string',
                'description' => 'sometimes|required|string',
            ];
        }
    }
}
