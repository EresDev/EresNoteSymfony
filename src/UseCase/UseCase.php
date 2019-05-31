<?php

namespace App\UseCase;

use App\Domain\Service\Http\Response;

interface UseCase
{
    public function execute(array $data) : Response;
}
