<?php

namespace Acme\DemoBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class JtestControllerTest extends WebTestCase
{
    public function testBasic()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/basic');
    }

}
