<?php

namespace App\Domain\Repository;

use App\Domain\Entity\Entity;

interface Repository extends EntitySingleGetter, EntityAllGetter, EntitySaver
{
}
