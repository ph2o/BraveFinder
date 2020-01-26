<?php

namespace App\Tests;

use Liip\TestFixturesBundle\Test\FixturesTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BraveFinderTest extends WebTestCase
{
    use FixturesTrait;

    public function testIndex()
    {
        // add all your fixtures classes that implement
        // Doctrine\Common\DataFixtures\FixtureInterface
        $this->loadFixtures(['App\DataFixtures\AppFixtures']);

        // you can now run your functional tests with a populated database
        $client = $this->createClient();
        $crawler = $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('title', 'Brave Finder application');
        // ...
    }

    public function testBraveFinderIndex()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'BraveFinder');
    }

    /**
     * @dataProvider urlProvider
     */
    public function testPageIsSuccessful($url)
    {
        $client = static::createClient();
        $client->request('GET', $url);

        $this->assertResponseIsSuccessful();
    }

    public function urlProvider()
    {
        yield ['/'];
        //yield ['/candidate'];
        // yield ['/practice'];
        // yield ['/blog/category/fixture-category'];
        // yield ['/archives'];
        // ...
    }
}
