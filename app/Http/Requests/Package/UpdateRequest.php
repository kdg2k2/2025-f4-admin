<?php

namespace App\Http\Requests\Package;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
    {
        $this->merge([
            // 'per_page' => $this->per_page ?? null,
            // 'page' => $this->page ?? null,
        ]);
    }

    public function rules(): array
    {
        return [
            'id' => 'required|integer|exists:packages,id',
            'name' => 'required|string|max:255|unique:packages,name,' . $this->id,
            'download_document_limit' => 'required|integer|min:0',
            'price' => 'required|integer|min:0',
            'duration_days' => 'required|integer|min:1',
        ];
    }
}
