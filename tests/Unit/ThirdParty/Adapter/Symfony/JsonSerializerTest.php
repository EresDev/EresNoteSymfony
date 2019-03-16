<?php


namespace EresNote\Tests\Unit\ThirdParty\Adapter\Symfony;


use EresNote\ThirdParty\Adapter\Symfony\JsonSerializerAdapter;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Serializer\SerializerInterface;

class JsonSerializerTest extends TestCase
{
    public function testSerialize_WithArray() : void
    {
        $expectedOutputFromArray = $this->getExpectedOutputFromArray();

        $thirdPartySerializerStub = $this->getSerializerStub($expectedOutputFromArray);

        $serializer = new JsonSerializerAdapter($thirdPartySerializerStub);

        $sampleInputArray = $this->getSampleInputArray();

        $serializedJsonString = $serializer->serialize($sampleInputArray);

        $this->assertEquals($expectedOutputFromArray, $serializedJsonString);
    }

    private function getSerializerStub($expectedOutput)
    {
        $serializerStub = $this->createMock(SerializerInterface::class);

        $serializerStub->method('serialize')
            ->willReturn($expectedOutput);

        return $serializerStub;
    }

    private function getSampleInputArray() : array
    {
        $sampleInputArray = ['key1' => 'value1', 'key2' => 'value2'];
        return $sampleInputArray;
    }

    private function getExpectedOutputFromArray(): string
    {
        $expectedOutputFromArray = '{"key1":"value1","key2":"value2"}';
        return $expectedOutputFromArray;
    }


    public function testSerialize_WithObject() : void
    {
        $expectedOutputFromObject = $this->getExpectedOutputFromObject();

        $thirdPartySerializerStub = $this->getSerializerStub($expectedOutputFromObject);

        $serializer = new JsonSerializerAdapter($thirdPartySerializerStub);

        $sampleInputObject = $this->getSampleInputObject();

        $serializedJsonString = $serializer->serialize($sampleInputObject);

        $this->assertEquals($expectedOutputFromObject, $serializedJsonString);
    }

    private function getSampleInputObject() : object
    {
        $sampleInputObject = new \stdClass();
        $sampleInputObject->key1 = 'value1';
        $sampleInputObject->key2 = 'value2';

        return $sampleInputObject;
    }

    private function getExpectedOutputFromObject(): string
    {
        $expectedOutputFromArray = '{"[\'key1\' ":" \'value1","key2\' ":" \'value2\']"}';
        return $expectedOutputFromArray;
    }

}
