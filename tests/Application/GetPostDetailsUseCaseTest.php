<?php

namespace App\Test\Application;

use App\Domain\Response\PostDetailResponse;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Domain\Entity\Post;
use App\Domain\Entity\User;
use App\Application\GetPostDetailsUseCase;

class GetPostDetailsUseCaseTest extends KernelTestCase
{   
    public function testGetPostDetailsUseCase(){
        $getPostDetailsUseCase = self::getContainer()->get(GetPostDetailsUseCase::class);
        $postRepository = $this->getPostRespository();
        $userRepository = $this->getUserRespository();

        $postDetail = $getPostDetailsUseCase($postRepository, $userRepository, 1);

        $this->assertInstanceOf(PostDetailResponse::class, $postDetail);
        $this->assertEquals($postDetail->getPost()->getId(), $postRepository->findOneById($postDetail->getPost()->getId())->getId());
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
