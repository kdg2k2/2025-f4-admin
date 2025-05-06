<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use ReflectionClass;

class CustomValidateRequestService
{
    public function validate(array $request, $customRequest)
    {
        $custom = $this->createCustomRequest($request, $customRequest);

        $custom->setContainer(app())->setRedirector(app(Redirector::class));
        $custom->prepareForValidation();

        $validator = Validator::make(
            $custom->all(),
            $custom->rules(),
            $custom->messages(),
            $custom->attributes()
        );

        if ($validator->fails()) {
            $reflection = new ReflectionClass($validator);
            $property = $reflection->getProperty('failedRules');
            $property->setAccessible(true);
            $failedRules = $property->getValue($validator);

            throw ValidationException::withMessages([
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
                'failed_rules' => $failedRules
            ]);
        }

        return $validator->validated();
    }

    protected function createCustomRequest(array $request, $customRequest): mixed
    {
        $base = new Request($request);
        return $customRequest->createFrom($base);
    }
}
