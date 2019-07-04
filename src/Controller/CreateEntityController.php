<?php

namespace App\Controller;

use App\Domain\Service\Http\Request\PostParametersProvider;
use App\Domain\Service\ValueObject\HttpResponse;
use App\Domain\UseCase\CreateUseCase;

abstract class CreateEntityController extends Controller
{
    private $createUseCase;
    private $postParametersProvider;

    public function __construct(
        CreateUseCase $useCase,
        PostParametersProvider $postParametersProvider
    ) {
        $this->postParametersProvider = $postParametersProvider;
        $this->createUseCase = $useCase;
    }

    protected function getResponse(): HttpResponse
    {
        $parameters = $this->postParametersProvider->getAll();

        return $this->createUseCase->execute($parameters);;
    }
}


