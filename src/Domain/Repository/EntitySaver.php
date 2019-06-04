<?php

namespace App\Domain\Repository;

use App\Domain\Entity\Entity;

interface EntitySaver
{
    public function save(Entity $entity);
}
