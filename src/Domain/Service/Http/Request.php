<?php

namespace App\Domain\Service\Http;

interface Request
{
    public function getAllPostData() : array;
}
