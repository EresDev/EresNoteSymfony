<?php

namespace EresNote\UseCase;

use EresNote\Domain\Entity\AbstractEntity;
use EresNote\Domain\Service\Factory\NoteFactory;
use EresNote\Domain\Service\ValueObject\SimpleHttpResponse;
use EresNote\Domain\Service\ValueObject\SimpleHttpResponseInterface;

class CreateNoteUseCase extends CreatorTemplate
{
    protected function getEntityFactory(): string
    {
        return NoteFactory::class;
    }

    protected function getSuccessResponse(AbstractEntity $entity): SimpleHttpResponseInterface
    {
        $response = $this->httpResponseFactory->create(200, $entity);
        return $response;
    }

    protected function getFailureResponse(array $errors): SimpleHttpResponseInterface
    {
        $response = $this->httpResponseFactory->create(422, $errors);
        return $response;
    }
}
