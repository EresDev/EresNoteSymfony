<?php

namespace App\Domain\Service\Http\Request;

interface PutParametersGetter
{
    public function getAll() : array;
}
