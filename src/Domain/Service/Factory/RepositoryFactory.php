<?php

namespace App\Domain\Service\Factory;

use App\Domain\Entity\AbstractEntity;
use App\Domain\Repository\Repository;

interface RepositoryFactory
{
    public function create(AbstractEntity $entity) : Repository;
}
