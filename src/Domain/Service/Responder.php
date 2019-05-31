<?php

namespace App\Domain\Service;

use App\Domain\Entity\AbstractEntity;
use App\Domain\Service\ValueObject\HttpResponse;

interface Responder
{
    public function prepare(AbstractEntity $entity) : HttpResponse;
}
