<?php

namespace App\Tests\Unit\Domain\Service\Responder;

use App\Domain\Service\Responder\CreatorResponder;
use App\Domain\Service\Responder\NoteCreatorResponder;

class NoteCreatorResponderBuilder extends CreatorResponderBuilder
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
