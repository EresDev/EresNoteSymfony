<?php

namespace App\Tests\Integration\ThirdParty\Adapter\Symfony;

use App\Tests\Extra\FixtureWebTestCase;
use App\Tests\Extra\TestEntity;
use App\ThirdParty\Adapter\Symfony\ValidatorAdapter;

class ValidatorAdapterTest extends FixtureWebTestCase
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
