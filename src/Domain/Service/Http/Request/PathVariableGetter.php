<?php

namespace App\Domain\Service\Http\Request;

interface PathVariableGetter
{
    public function get(string $key, string $defaultValue = null) : string;
}
