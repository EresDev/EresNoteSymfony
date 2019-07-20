<?php

namespace App\Domain\Exception;

class UserNotAuthenticatedException extends HttpException
{
    public static function get() : self
    {
        return new self(
            401,
            'User is not authenticated to perform the action.'
        );
    }

    public function getMessageForEndUser(): string
    {
        return 'exception.text.user.is.not.logged.in';
    }
}
