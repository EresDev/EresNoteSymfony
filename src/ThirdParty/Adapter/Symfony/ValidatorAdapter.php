<?php

namespace EresNote\ThirdParty\Adapter\Symfony;

use EresNote\Domain\Entity\AbstractEntity;

use EresNote\Domain\Service\ValidatorInterface;
use EresNote\Domain\Service\ValueObject\ValidatorResponse;
use EresNote\Domain\Service\ValueObject\ValidatorResponseInterface;
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

    public function validate(AbstractEntity $entity): ValidatorResponseInterface
    {
        $this->prepare($entity);

        $valid = $this->isValid();
        $errors = $this->getErrors();

        $validatorResponse = new ValidatorResponse($valid, $errors);

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
