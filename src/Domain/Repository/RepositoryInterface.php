<?php

namespace App\Domain\Repository;

use App\Domain\Entity\AbstractEntity;

interface RepositoryInterface
{
    public function getById($id);
    public function getAll();
    public function persist(AbstractEntity $entity);
}
