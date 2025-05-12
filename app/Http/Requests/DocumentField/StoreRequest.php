<?php

namespace App\Http\Requests\DocumentField;

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
            'name' => 'required|string|unique:document_fields,name',
            'bg_class' => 'required|string',
            'tx_class' => 'required|string',
            'icon_class' => 'required|string',
        ];
    }
}
