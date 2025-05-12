<?php

namespace App\Http\Requests\DocumentField;

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
            'id' => 'required|integer|exists:document_fields,id',
            'name' => 'required|string|unique:document_fields,name,' . $this->id,
            'bg_class' => 'required|string',
            'tx_class' => 'required|string',
            'icon_class' => 'required|string',
        ];
    }
}
