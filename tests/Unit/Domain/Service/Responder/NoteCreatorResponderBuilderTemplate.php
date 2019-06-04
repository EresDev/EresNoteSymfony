<?php

namespace App\Tests\Unit\Domain\Service\Responder;

use App\Domain\Service\Responder\CreatorResponder;
use App\Domain\Service\Responder\NoteCreatorResponder;

class NoteCreatorResponderBuilderTemplate extends CreatorResponderBuilderTemplate
{
    public function getCreatorResponderInstance(): CreatorResponder
    {
        return new NoteCreatorResponder(
            $this->validator,
            $this->httpResponseFactory,
            $this->entitySaver
        );
    }
}
