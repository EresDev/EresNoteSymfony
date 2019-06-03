<?php

namespace App\Domain\Repository;

interface EntitySaver
{
    public function persist(Entity $entity);
}
