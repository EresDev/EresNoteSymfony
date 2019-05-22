<?php
namespace EresNote\Tests\Integration\ThirdParty\Adapter\Symfony;

use EresNote\Tests\Integration\IntegrationTestCase;
use EresNote\ThirdParty\Adapter\Symfony\JsonSerializerAdapter;

class JsonSerializerAdapterTest extends IntegrationTestCase
{
    private $serializer;

    protected function setUp() : void
    {
        parent::setUp();
        $this->serializer = parent::getService(
            'Symfony\Component\Serializer\SerializerInterface'
        );
    }

    public function testSerializeOnArray() : void
    {
        $sampleArray = ['id' => 123, 'name' => 'Test name'];

        $jsonSerializerAdapter = new JsonSerializerAdapter($this->serializer);
        $serializedArray = $jsonSerializerAdapter->serialize($sampleArray);

        $expected = '{"id":123,"name":"Test name"}';

        $this->assertEquals($expected, $serializedArray);
    }

    public function testSerializeOnObject() : void
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

        $jsonSerializerAdapter = new JsonSerializerAdapter($this->serializer);
        $serializedObject = $jsonSerializerAdapter->serialize($sampleObject);

        $expected = '{"userId":123,"name":"Test name"}';

        $this->assertEquals($expected, $serializedObject);
    }
}
