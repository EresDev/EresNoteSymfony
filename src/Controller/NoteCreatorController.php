<?php

namespace App\Controller;

use App\Domain\Service\Http\Request\PostParametersGetter;
use App\Domain\Service\ValueObject\HttpResponse;
use App\Domain\UseCase\UseCase;

class NoteCreatorController extends Controller
{
    /**
     * @var \App\Domain\UseCase\UseCase
     */
    private $useCase;
    /**
     * @var PostParametersGetter
     */
    private $postParametersGetter;

    public function __construct(
        UseCase $useCase,
        PostParametersGetter $postParametersGetter
    ) {
        $this->postParametersGetter = $postParametersGetter;
        $this->useCase = $useCase;
    }

    protected function getResponse(): HttpResponse
    {
        $parameters = $this->postParametersGetter->getAll();
        $response = $this->useCase->execute($parameters);

        return $response;
    }
}
