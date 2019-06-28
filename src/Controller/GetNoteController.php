<?php

namespace App\Controller;

use App\Domain\Service\Http\Request\PathVariableGetter;
use App\Domain\Service\ValueObject\HttpResponse;
use App\Domain\UseCase\RetrieveUseCase;

class GetNoteController extends Controller
{
    private $retrieveUseCase;
    private $pathVariableGetter;

    public function __construct(
        RetrieveUseCase $retrieveUseCase,
        PathVariableGetter $pathVariableGetter
    ) {
        $this->retrieveUseCase = $retrieveUseCase;
        $this->pathVariableGetter = $pathVariableGetter;
    }

    protected function getResponse(): HttpResponse
    {
        $noteId = $this->pathVariableGetter->get('noteId');

        return $this->retrieveUseCase->execute($noteId);
    }
}
