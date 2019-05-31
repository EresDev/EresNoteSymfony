<?php

namespace App\Domain\Service\Factory;

use App\Domain\Entity\AbstractEntity;

interface EntityFactory
{
    public function createFromParameters(array $parameters) : AbstractEntity;
}
