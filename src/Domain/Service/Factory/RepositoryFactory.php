<?php

namespace App\Domain\Service\Factory;

use App\Domain\Entity\Entity;
use App\Domain\Repository\Repository;

interface RepositoryFactory
{
    public function create(Entity $entity) : Repository;
}
