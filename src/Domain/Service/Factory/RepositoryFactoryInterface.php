<?php
namespace App\Domain\Service\Factory;

use App\Domain\Entity\AbstractEntity;
use App\Domain\Repository\Repository;

interface RepositoryFactoryInterface
{
    public function create(AbstractEntity $entity) : Repository;
}
