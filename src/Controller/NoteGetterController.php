<?php

namespace App\Controller;

use App\Domain\Service\Http\Request\GetParameterGetter;
use App\Domain\Service\ValueObject\HttpResponse;
use App\Domain\UseCase\UseCase;

class NoteGetterController extends Controller
{
    /**
     * @var UseCase
     */
    private $useCase;

    /**
     * @var GetParameterGetter
     */
    private $getParameterGetter;

    public function __construct(UseCase $useCase, GetParameterGetter $getParameterGetter)
    {
        $this->useCase = $useCase;
        $this->getParameterGetter = $getParameterGetter;
    }

    protected function getResponse(): HttpResponse
    {
        $noteId = $this->getParameterGetter->get('noteId');

        return $this->useCase->execute($noteId);
    }
}
