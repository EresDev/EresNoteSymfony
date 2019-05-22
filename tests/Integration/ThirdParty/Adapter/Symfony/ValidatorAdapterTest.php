<?php
namespace EresNote\Tests\Integration\ThirdParty\Adapter\Symfony;

use EresNote\Tests\Extra\TestEntity;
use EresNote\Tests\Integration\IntegrationTestCase;
use EresNote\ThirdParty\Adapter\Symfony\ValidatorAdapter;

class ValidatorAdapterTest extends IntegrationTestCase
{
    private $validator;

    protected function setUp()
    {
        parent::setUp();
        $this->validator = parent::getService(
            'Symfony\Component\Validator\Validator\ValidatorInterface'
        );
    }

    public function testValidateForValidEntity()
    {
        $validEntity = new TestEntity('A valid title');

        $validatorAdapter = new ValidatorAdapter($this->validator);
        $validatorResponse = $validatorAdapter->validate($validEntity);

        $this->assertTrue($validatorResponse->isValid());
    }

    public function testValidateForInValidEntity()
    {
        $invalidEntityWithEmptyTitle = new TestEntity('');

        $validatorAdapter = new ValidatorAdapter($this->validator);
        $validatorResponse = $validatorAdapter->validate($invalidEntityWithEmptyTitle);

        $this->assertFalse($validatorResponse->isValid());
    }

}
