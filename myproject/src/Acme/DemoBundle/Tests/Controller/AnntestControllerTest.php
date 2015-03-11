<?php

namespace Acme\DemoBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AnntestControllerTest extends WebTestCase
{
    public function testOla()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/ola');
    }

}
