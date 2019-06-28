<?php

namespace App\Domain\UseCase;

use App\Domain\Service\ValueObject\HttpResponse;

interface CreateUseCase
{
    public function execute(array $data) : HttpResponse;
}
