<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateAnswerRequest extends FormRequest
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
        return [
            'question_id' => ['required', Rule::exists("questions", 'id')],
            'label'     => 'required|max:1',
            'a-text'    => 'required|max:255',
            'a-img'     => 'image|mimes:jpeg,png,jpg|max:2048',
            'IsCorrect' => 'required|boolean'
        ];
    }
}
