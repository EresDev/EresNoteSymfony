<?php

namespace App\Domain\Service\Http;

interface Response
{
    public function getStatusCode() : int;
    public function getContent() : string;
}
