<?php
namespace App\Tests\Integration;

use Liip\FunctionalTestBundle\Test\WebTestCase;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

abstract class IntegrationTestCase extends WebTestCase
{
    protected function setUp()
    {
        self::bootKernel();
    }

    protected function getService(string $serviceId) : object
    {
        return self::$container->get($serviceId);
    }
}
