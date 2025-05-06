<?php

namespace App\Http\Requests\Document;

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
            'uploader_id' => auth()->id(),
        ]);
    }

    public function rules(): array
    {
        return [
            'type_id' => 'required|integer|exists:document_types,id',
            'uploader_id' => 'required|integer|exists:admins,id',
            'title' => 'required|string',
            'price' => 'required|integer|min:0',
            'path' => 'required|mimes:pdf',
        ];
    }
}
