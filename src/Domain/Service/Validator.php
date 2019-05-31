<?php

namespace App\Domain\Service;

use App\Domain\Entity\AbstractEntity;
use App\Domain\Service\ValueObject\ValidatorResponseInterface;

interface Validator
{
    public function validate(AbstractEntity $entity) : ValidatorResponseInterface;
}
