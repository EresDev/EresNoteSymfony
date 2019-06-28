<?php

namespace App\Domain\UseCase;

use App\Domain\Service\ValueObject\HttpResponse;

interface RetrieveUseCase
{
    public function execute(int $entityId) : HttpResponse;
}
