<?php

namespace App\Domain\Service;

use App\Domain\Entity\AbstractEntity;
use App\Domain\Service\ValueObject\ValidatorResponse;

interface Validator
{
    public function validate(AbstractEntity $entity) : ValidatorResponse;
}
