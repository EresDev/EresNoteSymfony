<?php

namespace App\Domain\Service;

use App\Domain\Entity\Entity;
use App\Domain\Service\ValueObject\HttpResponse;

interface Responder
{
    public function prepare(Entity $entity) : HttpResponse;
}
