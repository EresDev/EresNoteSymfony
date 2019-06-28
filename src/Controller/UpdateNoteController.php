<?php

namespace App\Controller;

use App\Domain\Service\Http\Request\PutParametersGetter;
use App\Domain\Service\ValueObject\HttpResponse;
use App\Domain\UseCase\CreateUseCase;

class UpdateNoteController extends Controller
{
    private $createUseCase;
    private $putParametersGetter;

    public function __construct(
        CreateUseCase $createUseCase,
        PutParametersGetter $putParametersGetter
    ) {
        $this->createUseCase = $createUseCase;
        $this->putParametersGetter = $putParametersGetter;
    }

    protected function getResponse(): HttpResponse
    {
        $noteUpdatedData = $this->putParametersGetter->getAll();

        return $this->createUseCase->execute($noteUpdatedData);
    }
}
