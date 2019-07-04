<?php

namespace App\Domain\Service\Http\Request;

interface PostParametersProvider
{
    public function getAll() : array;
}
