<?php

namespace App\Http\Requests\Admin;

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
            // 'password' => $this->password ?? null,
            // 'path' => $this->path ?? null,
        ]);
    }

    public function rules(): array
    {
        return [
            'id' => 'required|integer|exists:admins,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:admins,email,' . $this->id,
            'password' => 'nullable|string|max:255',
            'path' => 'nullable|mimes:png,jpg,jpeg',
        ];
    }
}
