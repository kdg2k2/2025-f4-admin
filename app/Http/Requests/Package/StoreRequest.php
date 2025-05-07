<?php

namespace App\Http\Requests\Package;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'name' => 'required|string|max:255|unique:packages,name',
            'download_document_limit' => 'required|integer|min:0',
            'price' => 'required|integer|min:0',
            'duration_days' => 'nullable|integer|min:1',
        ];
    }
}
