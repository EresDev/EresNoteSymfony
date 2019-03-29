<?php

namespace EresNote\Domain\Service;

use EresNote\Domain\Entity\AbstractEntity;
use EresNote\Domain\Service\ValueObject\SimpleHttpResponseInterface;

interface ResponderInterface
{
    public function prepare(AbstractEntity $entity) : SimpleHttpResponseInterface;
}
