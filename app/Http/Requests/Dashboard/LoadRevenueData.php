<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class LoadRevenueData extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'from' => $this->from ?? null,
            'to' => $this->to ?? null,
        ]);
    }

    public function rules(): array
    {
        return [
            'from' => 'nullable|date_format:Y-m-d|before_or_equal:to',
            'to'   => 'nullable|date_format:Y-m-d|after_or_equal:from',
        ];
    }
}
