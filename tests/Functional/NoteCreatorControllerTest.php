<?php

namespace EresNote\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class NoteCreatorControllerTest extends WebTestCase
{
    public function testCreate()
    {
        $client = static::createClient();
        $client->enableProfiler();
        $client->request(
            'POST',
            '/note',
            [
                "title" => "A test title",
                "content" => "some test content",
                "creationTimestamp" => "123",
                "user" => "1",
                "id" => 123
            ],
            [],
            [
                'CONTENT_TYPE' => 'application/json'
            ],
            '{"title":"A test title", "content":"some test content", "creationTimestamp":"123", "user":"1"}'

        );


        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

}
