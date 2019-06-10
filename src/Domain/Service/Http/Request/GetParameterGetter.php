<?php

namespace App\Domain\Service\Http\Request;

interface GetParameterGetter
{
    public function get(string $key, string $defaultValue = null) : string;
}
