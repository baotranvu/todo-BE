<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Enums\TaskPriority;
use Illuminate\Validation\Rules\Enum;

class UpdateTaskRequest extends FormRequest
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
            'priority' => ['required', 'string', new Enum(TaskPriority::class)],
            'description' => 'required|string|max:255',
            'progress' => 'required|integer|between:0,100',
            'start_date' => 'required|date|before_or_equal:due_date',
            'due_date' => 'required|date|after_or_equal:start_date',
        ];
    }
}
