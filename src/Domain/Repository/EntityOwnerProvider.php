<?php

namespace App\Domain\Repository;

use App\Domain\Entity\User;

interface EntityOwnerProvider
{
    public function getOwner(int $entityId) : ?User;
}
