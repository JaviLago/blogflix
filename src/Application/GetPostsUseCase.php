<?php

namespace App\Application;

use App\Domain\Entity\Post;
//use App\Infrastructure\Repository\PostRepository;
use App\Domain\Interfaces\PostRepositoryInterface;

class GetPostsUseCase
{
    public function __invoke(PostRepositoryInterface $postRepository, ?string $filterByTitle){
        return $postRepository->findAllWithFilter($filterByTitle);
    }
 
    /**
     * @return Uuid
     */
    /*
    private function generatePostId(): Uuid
    {
        $maxAttempts = 5;
        $attempts = 0;

        $id = $this->idGenerator->generate();

        while ($attempts < $maxAttempts && !is_null($this->postRepository->findOneById($id))) {

            $id = $this->idGenerator->generate();

            $attempts++;
            if ($attempts >= $maxAttempts) {
                // throw new IdGenerationAttemptsExceeded($maxAttempts);
            }
        }

        return $id;
    }
    */

    /**
     * @param Post $post
     *
     * @return void
     */
    /*
    protected function validate(Post $post): void
    {
        lazy()
            ->that($post->getTitle())->notBlank()->minLength(3)
            ->that($post->getContent())->notBlank()->minLength(10)
            ->that($post->getPublishedAt())->nullOr()->isInstanceOf(DateTimeInterface::class)
            ->verifyNow();
    }
    */
}
