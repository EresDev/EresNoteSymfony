<?php

namespace App\Domain\Repository;

use App\Domain\Entity\Entity;

interface EntitySaver
{
    public function persist(Entity $entity);
}
