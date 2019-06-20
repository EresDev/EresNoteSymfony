<?php

namespace App\Domain\Repository;

interface Repository extends EntitySingleGetter, EntityAllGetter, EntitySaver, EntityDeleter
{
}
