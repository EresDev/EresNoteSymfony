<?php

namespace App\Controller;

use App\Domain\Service\Http\Request\PostParametersGetter;
use App\Domain\Service\ValueObject\HttpResponse;
use App\Domain\UseCase\UseCase;

class CreateNoteController extends Controller
{
    private $useCase;
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
        // TODO: use current user, remove userId sent via POST
        $parameters = $this->postParametersGetter->getAll();

        return $this->useCase->execute($parameters);;
    }
}
