<?php

namespace App\Test\Application;

use App\Domain\Response\PostDetailResponse;
use App\Domain\Interfaces\PostRepositoryInterface;
use App\Domain\Interfaces\UserRepositoryInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Domain\Entity\Post;
use App\Domain\Entity\User;

class GetPostDetailsUseCaseTest extends KernelTestCase
{   
    /*
    public function __invoke(PostRepositoryInterface $postRepository, UserRepositoryInterface $userRepository, int $id): ?PostDetailResponse{

        $post = $postRepository->findOneById($id);
        $author = $userRepository->findOneById($post->getUserId());
        $result = new PostDetailResponse($post, $author);
        return $result;
    }
    */

    public function testFind(){

        $postRepository = $this->getPostRespository();
        $userRepository = $this->getUserRespository();

        $post = $postRepository->findOneById(1);


        $this->assertEquals("1", $post?->getId());
        //self::assertResponseStatusCodeSame(200);
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
