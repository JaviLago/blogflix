<?php

namespace App\Test\Application;

use App\Domain\Response\PostDetailResponse;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Domain\Entity\Post;
use App\Domain\Entity\User;
use App\Application\GetPostsUseCase;

class GetPostsUseCaseTest extends KernelTestCase
{   
    public function testGetPostDetailsUseCase(){
        $getPostsUseCase = self::getContainer()->get(GetPostsUseCase::class);
        $postRepository = $this->getPostRespository();
        $userRepository = $this->getUserRespository();

        $postsList = $getPostsUseCase($postRepository, $userRepository, null);
        
        $this->assertNotEmpty($postsList);
        $this->assertEquals($postsList[1]?->getPost()?->getId(), $postRepository->findOneById($postsList[1]?->getPost()?->getId())?->getId());
    }

    public function getPostRespository(){
        $doctrine = static::getContainer()->get('doctrine');

        /** @var DoctrinePostRepository $repository */
        $repository = $doctrine->getRepository(Post::class);
        return $repository;
    }

    public function getUserRespository(){
        $doctrine = static::getContainer()->get('doctrine');

        /** @var DoctrinePostRepository $repository */
        $repository = $doctrine->getRepository(User::class);
        return $repository;
    }
}
