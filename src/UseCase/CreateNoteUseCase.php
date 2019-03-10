<?php

namespace EresNote\UseCase;

use EresNote\Domain\Entity\AbstractEntity;
use EresNote\Domain\Service\Factory\NoteFactory;
use EresNote\Domain\Service\ValueObject\SimpleResponse;
use EresNote\Domain\Service\ValueObject\SimpleResponseInterface;

class CreateNoteUseCase extends CreatorTemplate
{
    protected function getEntityFactory(): string
    {
        return NoteFactory::class;
    }

    protected function getSuccessResponse(AbstractEntity $entity): SimpleResponseInterface
    {
        $response = new SimpleResponse(200, $entity);
        return $response;
    }

    protected function getFailureResponse(array $errors): SimpleResponseInterface
    {
        $response = new SimpleResponse(422, $errors);
        return $response;
    }
}
