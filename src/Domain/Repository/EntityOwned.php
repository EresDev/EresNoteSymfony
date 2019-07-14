<?php

namespace App\Domain\Repository;

use App\Domain\Entity\User;

interface EntityOwned
{
    public function getOwner(int $entityId) : ?User;
}
