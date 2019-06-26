<?php

namespace App\Domain\Service\Responder;

use App\Domain\Service\ValueObject\HttpResponse;

interface Responder
{
    public function prepare($data) : HttpResponse;
}
