<?php

namespace App\Domain\Repository;

use App\Domain\Entity\Entity;

interface EntityUpdater
{
    public function update(Entity $entity) : void;
}
