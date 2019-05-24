<?php
namespace App\Domain\Service\Factory;

use App\Domain\Entity\AbstractEntity;
use App\Domain\Repository\RepositoryInterface;

interface RepositoryFactoryInterface
{
    public function create(AbstractEntity $entity) : RepositoryInterface;
}
