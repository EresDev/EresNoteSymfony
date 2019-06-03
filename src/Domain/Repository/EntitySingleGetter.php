<?php

namespace App\Domain\Repository;

interface EntitySingleGetter
{
    public function getById($id);
}
