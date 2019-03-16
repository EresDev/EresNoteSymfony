<?php


namespace EresNote\Tests\Unit\UseCase;

use EresNote\Domain\Service\ValidatorInterface;
use EresNote\Domain\Service\ValueObject\ValidatorResponseInterface;
use EresNote\UseCase\CreateNoteUseCase;
use PHPUnit\Framework\TestCase;

class CreateNoteUseCaseTest extends CreatorTestBase
{
    public function testExecute_WithValidData()
    {
        $validator = $this->getValidator(true, $this->responseContentForValidParameters);
        $repository = $this->getRepository();
        $httpResponseFactory = $this->getHttpResponseFactory(
            $this->validStatusCode,
            $this->responseContentForValidParameters
        );

        $createNoteUseCase = new CreateNoteUseCase($validator, $repository, $httpResponseFactory);

        $response = $createNoteUseCase->execute($this->dummyRequestParameters);

        $this->assertEquals($this->validStatusCode, $response->getStatusCode());
        $this->assertEquals($this->responseContentForValidParameters, $response->getContent());
    }


    public function testExecute_WithInvalidData()
    {
        $validator = $this->getValidator(false, $this->responseContentForInvalidParameters);
        $repository = $this->getRepository();
        $httpResponseFactory = $this->getHttpResponseFactory(
            $this->invalidStatusCode,
            $this->responseContentForInvalidParameters
        );

        $createNoteUseCase = new CreateNoteUseCase($validator, $repository, $httpResponseFactory);

        $response = $createNoteUseCase->execute($this->dummyRequestParameters);

        $this->assertEquals($this->invalidStatusCode, $response->getStatusCode());

        $expectedResposneContent = json_encode($this->responseContentForInvalidParameters);

        $this->assertEquals($expectedResposneContent, $response->getContent());
    }

}
