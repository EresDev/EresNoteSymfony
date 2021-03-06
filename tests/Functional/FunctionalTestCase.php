<?php

namespace App\Tests\Functional;

use App\Tests\Extra\DataFixture\AuthUserFixture;
use App\Tests\Extra\DataFixture\AuthUserSecondFixture;
use App\Tests\Extra\Exception\FixtureNotLoadedException;
use App\Tests\Extra\FixtureWebTestCase;
use Symfony\Component\BrowserKit\Client;

abstract class FunctionalTestCase extends FixtureWebTestCase
{
     /**
     * @var Client
     */
    protected $client;
    private $authUserId;

    protected function setUp()
    {
        parent::setUp();
        $this->cleanDatabase();
        $this->client = static::createClient();
    }

    protected function createAuthenticatedClient(
        string $email = AuthUserFixture::EMAIL,
        string $password = AuthUserFixture::PASSWORD,
        string $fixtureClass = AuthUserFixture::class
    ) : void {

        try {
            $this->authUserId = $this->getFixtureId($fixtureClass);
        } catch (FixtureNotLoadedException $fixtureNotLoadedException) {
            throw new FixtureNotLoadedException(
                sprintf(
                    'The fixture %s must be loaded before you can create ' .
                    'an authenticated client.',
                    $fixtureClass
                ),
                0,
                $fixtureNotLoadedException
            );
        }

        $this->client->request(
            'post',
            '/login_check',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode([
                'email' => $email,
                'password' => $password,
            ])
        );

        $data = json_decode($this->client->getResponse()->getContent(), true);

        $this->client = static::createClient();
        $this->client->setServerParameter('HTTP_Authorization', sprintf('Bearer %s', $data['token']));
    }

    public function createAuthenticatedClientForSecondUser(
        string $email = AuthUserSecondFixture::EMAIL,
        string $password = AuthUserSecondFixture::PASSWORD,
        string $fixtureClass = AuthUserSecondFixture::class
    ) : void
    {
        $this->createAuthenticatedClient($email, $password, $fixtureClass);
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

    protected function toArrayAssoc(string $json) : array
    {
        return json_decode($json, true);
    }

    protected function getAuthUserId() : int
    {
        return $this->authUserId;
    }
}
