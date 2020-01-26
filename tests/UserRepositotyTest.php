<?php

namespace App\Tests\Repository;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserRepositoryTest extends KernelTestCase
{
    public function testCount()
    {
        $kernel = self::bootKernel();
        $usersCount = self::$container->get(UserRepository::class)->count([]);
        $this->assertEquals(9, $usersCount);
    }
}
