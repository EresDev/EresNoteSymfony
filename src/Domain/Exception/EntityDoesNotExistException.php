<?php

namespace App\Domain\Exception;

class EntityDoesNotExistException extends HttpException
{
    public static function from(int $entityId, string $repositoryClass) : self
    {
        return new self(
            404,
            sprintf(
                'Owner of the given Entity ID does not exist in the database.\n ' .
                'Entity ID: %s.\n ' .
                'Entity repository class: %s.\n ',
                $entityId,
                $repositoryClass
            )
        );
    }

    public function getMessageForEndUser(): string
    {
        return 'exception.text.entity.does.not.exist';
    }
}
