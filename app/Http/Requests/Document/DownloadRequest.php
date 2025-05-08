<?php

namespace App\Http\Requests\Document;

use Illuminate\Foundation\Http\FormRequest;

class DownloadRequest extends FormRequest
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
            'document_id' => 'required|integer|exists:documents,id',
        ];
    }
}
