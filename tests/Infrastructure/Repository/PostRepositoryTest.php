<?php

namespace App\Test\Infrastructure\Repository;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Domain\Entity\Post;

class PostRepositoryTest extends KernelTestCase
{   
    public function testFindOneSuccess(){
        $postRepository = $this->getPostRespository();
        $post = $postRepository->findOneById(1);
        $this->assertEquals("1", $post?->getId());
    }

    public function testFindOneError(){
        $postRepository = $this->getPostRespository();
        $post = $postRepository->findOneById(-1);
        $this->assertEquals(null, $post);
    }

    public function testFind100Post(){
        $postRepository = $this->getPostRespository();
        $posts = $postRepository->findAllWithFilter(null);
        $this->assertCount(100, $posts);
    }
    
    public function getPostRespository(){
        $doctrine = static::getContainer()->get('doctrine');

        /** @var DoctrinePostRepository $repository */
        $repository = $doctrine->getRepository(Post::class);
        return $repository;
    }

    /*
    Note: It would be necessary to add test for the insertion and deletion checking the DB
    */
}
