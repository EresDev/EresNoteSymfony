<?php

namespace App\Domain\Service\Factory;

use App\Domain\Entity\Entity;

interface EntityFactory
{
    public function createFromParameters(array $parameters) : Entity;
}
