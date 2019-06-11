<?php

namespace App\Tests\Extra;

use App\Domain\Service\ValueObject\HttpResponse;

class ValidValues
{
    public static function getHttpResponse() : HttpResponse
    {
        return new HttpResponse(200, 'Some sample content.');
    }
}
