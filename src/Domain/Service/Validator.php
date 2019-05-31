<?php

namespace App\Domain\Service;

use App\Domain\Entity\Entity;
use App\Domain\Service\ValueObject\ValidatorResponse;

interface Validator
{
    public function validate(Entity $entity) : ValidatorResponse;
}
