<?php

namespace App\Tests\Integration\ThirdParty\Adapter\Symfony;

use App\Tests\Extra\FixtureWebTestCase;
use App\ThirdParty\Adapter\Symfony\RequestAdapter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

class RequestAdapterTest extends FixtureWebTestCase
{
    /**
     * @var \Symfony\Component\BrowserKit\Client
     */
    private $client;
    /**
     * @var RequestStack
     */
    private $requestStack;

    protected function setUp()
    {
        parent::setUp();

        $this->client = static::createClient();

        $this->requestStack = $this->getService(RequestStack::class);

        $request = Request::create('/', 'POST', ['test_key1' => 'test_value1']);

        $this->requestStack->push($request);
    }

    public function testGetAll() : void
    {
        $requestAdapter = new RequestAdapter($this->requestStack);

        $postData = $requestAdapter->getAll();

        $this->assertArrayHasKey('test_key1', $postData);
    }
}
