<?php

namespace App\ThirdParty\Adapter\Symfony;

use App\Domain\Entity\AbstractEntity;

use App\Domain\Service\ValidatorInterface;
use App\Domain\Service\ValueObject\ValidatorResponse;
use App\Domain\Service\ValueObject\ValidatorResponseInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface as SymfonyValidator;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class ValidatorAdapter implements ValidatorInterface
{
    private $validator;

    public function __construct(SymfonyValidator $validator)
    {
        $this->validator = $validator;
    }

    public function validate(AbstractEntity $entity): ValidatorResponseInterface
    {
        $constraintViolationList = $this->validator->validate($entity);

        $valid = $constraintViolationList->count() === 0;
        $errors = $this->extractErrors($constraintViolationList);

        $validatorResponse = new ValidatorResponse($valid, $errors);

        return $validatorResponse;
    }

    private function extractErrors(ConstraintViolationListInterface $constraintViolationList): array
    {
        $errors = [];
        foreach ($constraintViolationList as $index => $constraintViolation) {
            $propertyNameOfEntity = $constraintViolation->getPropertyPath();
            $errors[$index][$propertyNameOfEntity] = $constraintViolation->getMessage();
        }
        $errors;

        return $errors;
    }
}
