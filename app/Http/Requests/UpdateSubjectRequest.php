<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSubjectRequest extends FormRequest
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
        $subject = $this->route('subject'); // Gets the model instance via route parameter (route model binding)

        return [
            'name'       => ['required', Rule::unique('subjects', 'name')->ignore($subject->id) ],
            'college_id'    =>'required',
            'year'       => 'required',
            'specialize' => 'required',
            'semester'   => 'required'
        ];
    }
}
