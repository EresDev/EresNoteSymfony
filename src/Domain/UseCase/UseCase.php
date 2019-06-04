<?php

namespace App\Domain\UseCase;

use App\Domain\Service\ValueObject\HttpResponse;

interface UseCase
{
    public function execute(array $data) : HttpResponse;
}
