<?php
namespace EresNote\Tests\Integration\ThirdParty\Adapter\Symfony;

use EresNote\ThirdParty\Adapter\Symfony\JsonSerializerAdapter;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class JsonSerializerAdapterTest extends KernelTestCase
{
    private $symfonySerializer;

    protected function setUp()
    {
        self::bootKernel();
        $this->symfonySerializer = self::$container->get(
            'Symfony\Component\Serializer\SerializerInterface'
        );
    }

    public function testSerializeOnArray()
    {
        $sampleArray = ['id' => 123, 'name' => 'Test name'];

        $jsonSerializerAdapter = new JsonSerializerAdapter($this->symfonySerializer);
        $serializedArray = $jsonSerializerAdapter->serialize($sampleArray);

        $expected = '{"id":123,"name":"Test name"}';

        $this->assertEquals($expected, $serializedArray);
    }

    public function testSerializeOnObject()
    {
        $sampleObject = new class {
            public $userId;
            public $name;

            public function __construct()
            {
                $this->userId = 123;
                $this->name = "Test name";
            }
        };

        $jsonSerializerAdapter = new JsonSerializerAdapter($this->symfonySerializer);
        $serializedObject = $jsonSerializerAdapter->serialize($sampleObject);

        $expected = '{"userId":123,"name":"Test name"}';

        $this->assertEquals($expected, $serializedObject);
    }
}
