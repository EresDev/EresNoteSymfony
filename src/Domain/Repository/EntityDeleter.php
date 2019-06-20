<?php

namespace App\Domain\Repository;

interface EntityDeleter
{
    public function delete(int $entityId) : bool;
}
