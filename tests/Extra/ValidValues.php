<?php

namespace App\Tests\Extra;

use App\Domain\Service\ValueObject\HttpResponse;

class ValidValues
{
    public static function getHttpResponse(
        int $statusCode=200,
        $content='Some sample content.'
    ) : HttpResponse{

        if (is_object($content)) {
            return HttpResponse::fromObject($statusCode, $content);
        }else if(is_array($content)){
            return HttpResponse::fromObject($statusCode, $content);
        }

        return HttpResponse::fromString($statusCode, $content);
    }
}
