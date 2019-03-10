<?php

namespace EresNote\Service\Adapater\Symfony;

use EresNote\Domain\Entity\AbstractEntity;

use EresNote\Domain\Service\ValidatorInterface;
use EresNote\Domain\Service\ValueObject\ValidatorResponse;
use Symfony\Component\Validator\Validator\ValidatorInterface as SymfonyValidator;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class ValidatorAdapter implements ValidatorInterface
{
    private $validator;

    /**
     * @var ConstraintViolationListInterface
     */
    private $constraintViolationList;

    public function __construct(SymfonyValidator $validator)
    {
        $this->validator = $validator;
    }

    public function validate(AbstractEntity $entity): ValidatorResponse
    {
        $this->prepare($entity);

        $validatorResponse = new ValidatorResponse();
        $validatorResponse->isValid = $this->isValid();
        $validatorResponse->errors = $this->getErrors();

        return $validatorResponse;
    }

    private function prepare(AbstractEntity $entity): void
    {
        $this->constraintViolationList = $this->validator->validate($entity);
    }

    private function isValid(): bool
    {
        if ($this->constraintViolationList->count() === 0) {
            return true;
        }

        return false;
    }

    private function getErrors(): array
    {
        $errors = [];
        foreach ($this->constraintViolationList as $index => $constraintViolation) {
            $propertyNameOfEntity = $constraintViolation->getPropertyPath();
            $errors[$index][$propertyNameOfEntity] = $constraintViolation->getMessage();
        }
        $errors;

        return $errors;
    }
}
