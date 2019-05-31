<?php

namespace App\Domain\Service\ValueObject;

class ValidatorResponse
{
    private $valid;
    private $errors;

    public function __construct(bool $valid, array $errors)
    {
        $this->valid = $valid;;
        $this->errors = $errors;
    }

    public function isValid(): bool
    {
        return $this->valid;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}
