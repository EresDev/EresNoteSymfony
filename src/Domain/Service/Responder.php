<?php

namespace App\Domain\Service;

use App\Domain\Entity\Entity;
use App\Domain\Service\Http\Response;

interface Responder
{
    public function prepare(Entity $entity) : Response;
}
