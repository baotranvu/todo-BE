<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'priority' => 'required|string|in:low,medium,high',
            'description' => 'required|string|max:255',
            'progress' => 'required|integer|between:0,100',
            'start_date' => 'required|date',
            'due_date' => 'required|date',
        ];
    }
}
