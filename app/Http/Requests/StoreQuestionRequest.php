<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreQuestionRequest extends FormRequest
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
            'subject_id' => ['required', Rule::exists("subjects", 'id')],
            'number'     => 'required',
            'session'    => 'required',
            'q-text'     => 'required',
            'q-img'     => 'image',
            'A-img'     => 'image',
            'B-img'     => 'image',
            'C-img'     => 'image',
            'D-img'     => 'image',
            'E-img'     => 'image',
            'answers'             => 'required',
            'answers.*.label'     => 'required|max:1|in:A,B,C,D,E',
            'answers.*.a-text'    => 'required|max:255',
            'answers.*.hasImg'    => 'required|boolean',
            'answers.*.IsCorrect' => 'required|boolean'
        ];
    }
}
