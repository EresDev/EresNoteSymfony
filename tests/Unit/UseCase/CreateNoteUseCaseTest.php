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
        $validator = $this->getValidatorWithValidResponse();
        $repository = $this->getRepository();

        $createNoteUseCase = new CreateNoteUseCase($validator, $repository);

        $response = $createNoteUseCase->execute($this->dummyRequestParameters);

        $this->assertEquals($this->validStatusCode, $response->getStatusCode());
    }


    public function testExecute_WithInvalidData()
    {
        $validator = $this->getValidatorWithInvalidResponse();
        $repository = $this->getRepository();

        $createNoteUseCase = new CreateNoteUseCase($validator, $repository);

        $response = $createNoteUseCase->execute($this->dummyRequestParameters);

        $this->assertEquals($this->invalidStatusCode, $response->getStatusCode());
    }

}
