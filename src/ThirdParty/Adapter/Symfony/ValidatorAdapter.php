<?php

namespace App\ThirdParty\Adapter\Symfony;

use App\Domain\Entity\Entity;
use App\Domain\Service\Validator;
use App\Domain\Service\ValueObject\ValidatorResponse;
use Symfony\Component\Validator\Validator\ValidatorInterface as SymfonyValidator;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class ValidatorAdapter implements Validator
{
    private $validator;

    public function __construct(SymfonyValidator $validator)
    {
        $this->validator = $validator;
    }

    public function validate(Entity $entity): ValidatorResponse
    {
        $constraintViolationList = $this->validator->validate($entity);

        $valid = $constraintViolationList->count() === 0;
        $errors = $this->extractErrors($constraintViolationList);

        $validatorResponse = new ValidatorResponse($valid, $errors);

        return $validatorResponse;
    }

    private function extractErrors(
        ConstraintViolationListInterface $constraintViolationList
    ): array {
        $errors = [];
        foreach ($constraintViolationList as $index => $constraintViolation) {
            $propertyNameOfEntity = $constraintViolation->getPropertyPath();
            $errors[$index][$propertyNameOfEntity] = $constraintViolation->getMessage();
        }
        $errors;

        return $errors;
    }
}
