<?php

namespace App\Domain\Repository;

use App\Domain\Entity\Entity;

interface EntityDeleter
{
    public function delete(int $entityId) : ?Entity;
}
