<?php

namespace App\Tests\Functional;

use App\Tests\Extra\FixtureWebTestCase;
use Symfony\Component\BrowserKit\Client;

abstract class FunctionalTestCase extends FixtureWebTestCase
{
     /**
     * @var Client
     */
    protected $client;

    protected function setUp()
    {
        parent::setUp();

        $this->client = static::createClient();
    }

    protected function request(
        string $method,
        string $uri,
        array $parameters=[],
        array $files=[],
        array $server=[],
        string $content=null,
        bool $changeHistory=true
    ) : void {

        $this->client->request(
            $method,
            $uri,
            $parameters,
            $files,
            $server,
            $content,
            $changeHistory
        );

    }

    protected function getResponse(): object
    {
        return $this->client->getResponse();
    }

    protected function toObject(string $json) : object
    {
        return json_decode($json);
    }

}
