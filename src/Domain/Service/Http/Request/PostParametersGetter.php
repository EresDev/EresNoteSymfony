<?php

namespace App\Domain\Service\Http\Request;

interface PostParametersGetter
{
    public function getAll() : array;
}
