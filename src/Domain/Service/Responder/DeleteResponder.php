<?php

namespace App\Domain\Service\Responder;

use App\Domain\Service\ValueObject\HttpResponse;

interface DeleteResponder
{
    public function prepare() : HttpResponse;
}
