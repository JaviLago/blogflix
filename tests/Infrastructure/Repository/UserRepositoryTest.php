<?php

namespace App\Test\Infrastructure\Repository;

use App\Domain\Response\PostDetailResponse;
use App\Domain\Interfaces\PostRepositoryInterface;
use App\Domain\Interfaces\UserRepositoryInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Domain\Entity\Post;
use App\Domain\Entity\User;

class UserRepositoryTest extends KernelTestCase
{   
    public function testFindOneSuccess(){
        $userRepository = $this->getUserRespository();
        $user = $userRepository->findOneById(1);
        $this->assertEquals("1", $user?->getId());
    }

    public function testFindOneError(){
        $userRepository = $this->getUserRespository();
        $user = $userRepository->findOneById(-1);
        $this->assertEquals(null, $user);
    }

    public function getUserRespository(){
        $doctrine = static::getContainer()->get('doctrine');

        /** @var DoctrinePostRepository $repository */
        $repository = $doctrine->getRepository(User::class);
        return $repository;
    }
}
