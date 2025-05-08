<?php

namespace App\Http\Requests\Document;

use Illuminate\Foundation\Http\FormRequest;

class ListRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'per_page' => $this->per_page ?? null,
            'page' => $this->page ?? null,
            'field_id' => $this->field_id ?? null,
            'type_id' => $this->type_id ?? null,
            'uploader_id' => $this->uploader_id ?? null,
        ]);
    }

    public function rules(): array
    {
        return [
            'paginate' => 'required|in:0,1',
            'per_page' => 'nullable|integer|min:1',
            'page' => 'nullable|integer|min:1',
            'field_id' => 'nullable|integer|exists:document_fields,id',
            'type_id' => 'nullable|integer|exists:document_types,id',
            'uploader_id' => 'nullable|integer|exists:admins,id',
        ];
    }
}
