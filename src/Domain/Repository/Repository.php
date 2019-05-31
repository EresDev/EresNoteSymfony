<?php

namespace App\Domain\Repository;

use App\Domain\Entity\Entity;

interface Repository
{
    public function getById($id);
    public function getAll();
    public function persist(Entity $entity);
}
