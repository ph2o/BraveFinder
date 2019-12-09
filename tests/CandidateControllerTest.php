<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CandidateControllerTest extends WebTestCase
{
    public function setUp()
    { }

    public function testCandidateIndex()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/candidate/');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Candidats');
    }
}
