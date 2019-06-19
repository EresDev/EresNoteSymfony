<?php

namespace App\Tests\Extra;

use App\Domain\Service\ValueObject\HttpResponse;

class ValidValues
{
    public static function getHttpResponse(
        int $statusCode=200,
        $content='Some sample content.'
    ) : HttpResponse{

        if (!is_string($content)) {
            $content = json_encode($content);
        }

        return new HttpResponse($statusCode, $content);
    }
}
