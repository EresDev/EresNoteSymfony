<?php

namespace App\Domain\Service;

use App\Domain\Entity\AbstractEntity;
use App\Domain\Service\ValueObject\SimpleHttpResponseInterface;

interface ResponderInterface
{
    public function prepare(AbstractEntity $entity) : SimpleHttpResponseInterface;
}
