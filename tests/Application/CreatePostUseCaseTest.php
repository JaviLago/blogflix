<?php
namespace App\Test\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Domain\Entity\Post;
use App\Application\CreatePostUseCase;
use App\Domain\Request\PostCreateRequest;
use App\Domain\Response\PostCreateResponse;

class CreatePostUseCaseTest extends KernelTestCase
{   
    public function testCreatePostUseCaseSuccess(){
        $createPostUseCase = self::getContainer()->get(CreatePostUseCase::class);
        $postRepository = $this->getPostRespository();

        $userId = 1; // Simulate user loged "id" :)
        $title = "My title :)";
        $body = "My body ..........";

        $postCreateRequest = new PostCreateRequest($title, $body, $userId);

        $resultCreation = $createPostUseCase($postRepository, $postCreateRequest);

        $this->assertInstanceOf(PostCreateResponse::class, $resultCreation);
        $this->assertTrue($resultCreation->getIsSuccess());
    }

    public function testCreatePostUseCaseFail(){
        $createPostUseCase = self::getContainer()->get(CreatePostUseCase::class);
        $postRepository = $this->getPostRespository();

        $userId = 1; // Simulate user loged "id" :)
        $title = "Title"; // Too short :(
        $body = "Hi"; // Too short :(

        $postCreateRequest = new PostCreateRequest($title, $body, $userId);

        $resultCreation = $createPostUseCase($postRepository, $postCreateRequest);

        $this->assertInstanceOf(PostCreateResponse::class, $resultCreation);
        $this->assertFalse($resultCreation->getIsSuccess());
    }

    public function getPostRespository(){
        $doctrine = static::getContainer()->get('doctrine');

        /** @var DoctrinePostRepository $repository */
        $repository = $doctrine->getRepository(Post::class);
        return $repository;
    }
}
