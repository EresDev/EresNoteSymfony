<?php

namespace App\Domain\Service\Http;

interface RequestAdapterInterface
{
    public function getAllPostData() : array;
}
