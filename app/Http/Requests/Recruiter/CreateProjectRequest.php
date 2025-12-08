<?php

namespace App\Http\Requests\Recruiter;

use Illuminate\Foundation\Http\FormRequest;

class CreateProjectRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:255'],
            'budget' => ['required', 'numeric', 'min:0'],
            'category_id' => ['required', 'string', 'max:255', 'exists:project_categories,id'],
            'deadline' => ['required', 'date', 'after_or_equal:today'],
            'description' => ['required', 'string', 'max:1000'],
            'image' => ['nullable', 'file', 'mimes:png,jpg'],
            'document' => ['nullable', 'file', 'mimes:docs,docx,pdf'],
        ];
    }
}
