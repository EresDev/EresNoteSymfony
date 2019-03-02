<?php

namespace EresNote\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class NoteCreatorControllerTest extends WebTestCase
{
    public function testCreateValidData()
    {
        $client = static::createClient();
        $client->enableProfiler();
        $client->request(
            'POST',
            '/note',
            [
                "title" => "A test title",
                "content" => "some test content",
                "user" => 1,
                "id"=>14
            ],
            [],
            [
                'CONTENT_TYPE' => 'application/json'
            ],
            '{"title":"A test title", "content":"some test content", "creationTimestamp":"123", "user":"1"}'

        );


        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
//    public function testCreateEmptyUser()
//    {
//        $client = static::createClient();
//        $client->enableProfiler();
//        $client->request(
//            'POST',
//            '/note',
//            [
//                "title" => "A test title",
//                "content" => "some test content",
//                "creationTimestamp" => "2010-01-01 00:00:01",
//                "user" => "",
//                "id"=>"14"
//            ],
//            [],
//            [
//                'CONTENT_TYPE' => 'application/json'
//            ],
//            '{"title":"A test title", "content":"some test content", "creationTimestamp":"123", "user":"1"}'
//
//        );
//
//
//        $this->assertEquals(400, $client->getResponse()->getStatusCode());
//    }

}
