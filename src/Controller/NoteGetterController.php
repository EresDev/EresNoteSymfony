<?php

namespace App\Controller;

use App\Domain\Service\Http\Request\PathVariableGetter;
use App\Domain\Service\ValueObject\HttpResponse;
use App\Domain\UseCase\UseCase;

class NoteGetterController extends Controller
{
    /**
     * @var UseCase
     */
    private $useCase;

    /**
     * @var PathVariableGetter
     */
    private $pathVariableGetter;

    public function __construct(UseCase $useCase, PathVariableGetter $pathVariableGetter)
    {
        $this->useCase = $useCase;
        $this->pathVariableGetter = $pathVariableGetter;
    }

    protected function getResponse(): HttpResponse
    {
        $noteId = $this->pathVariableGetter->get('noteId');

        return $this->useCase->execute($noteId);
    }
}
