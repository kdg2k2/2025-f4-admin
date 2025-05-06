<?php

namespace App\Http\Requests\Document;

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
            'uploader_id' => auth()->id(),
        ]);
    }

    public function rules(): array
    {
        return [
            'id' => 'required|integer|exists:documents,id',
            'type_id' => 'required|integer|exists:document_types,id',
            'uploader_id' => 'required|integer|exists:admins,id',
            'title' => 'required|string',
            'price' => 'required|integer|min:0',
            'path' => 'nullable|mimes:pdf',
        ];
    }
}
