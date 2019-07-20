<?php

namespace App\Domain\Exception;

class UserIsNotTheOwnerException extends HttpException
{
    public static function from(
        int $entityId,
        int $authenticatedUserId,
        string $repositoryClass
    ) : self {
        return new self(
            401,
            sprintf(
                'Currently authenticated user is not the owner of the given Entity ID.\n ' .
                'Entity ID: %s.\n ' .
                'Currently authenticated user ID is %d.\n '.
                'Entity repository class: %s.\n ',
                $entityId,
                $authenticatedUserId,
                $repositoryClass
            )
        );
    }

    public function getMessageForEndUser(): string
    {
        return 'exception.text.user.is.not.the.owner.of.resource';
    }
}
