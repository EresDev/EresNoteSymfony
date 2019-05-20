<?php
namespace EresNote\Tests\Integration\ThirdParty\Adapter\Symfony;

use EresNote\Tests\Extra\TestEntity;
use EresNote\ThirdParty\Adapter\Symfony\ValidatorAdapter;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ValidatorAdapterTest extends KernelTestCase
{
    private $validator;

    protected function setUp()
    {
        self::bootKernel();

        $this->validator = self::$container->get(
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
