<?php

namespace App\Domain\Repository;

use App\Domain\Entity\Entity;

interface EntitySingleGetter
{
    public function getById($id) : Entity;
}
