<?php

namespace App\Http\Requests;

use App\Models\JsonSchema;
use App\Rules\JsonSchemaValid;
use Illuminate\Foundation\Http\FormRequest;

class StoreFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // You can implement authorization logic here
        // For now, allow all authenticated users
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $templateId = $this->route('templateId');
        $template = JsonSchema::findOrFail($templateId);
        
        return [
            'data' => ['required', new JsonSchemaValid($template->schema)]
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'data.required' => 'Data form harus diisi',
        ];
    }
}
