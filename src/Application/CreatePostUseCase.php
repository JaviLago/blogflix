<?php

namespace App\Application;

use App\Domain\Entity\Post;
use App\Domain\Interfaces\PostRepositoryInterface;

use App\Domain\Request\PostCreateRequest;
use App\Domain\Response\PostCreateResponse;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CreatePostUseCase
{
    public function __invoke(PostRepositoryInterface $postRepository,  PostCreateRequest $request/*, ValidatorInterface $validator*/) : PostCreateResponse{
        
        //return $postRepository->findAllWithFilter($filterByTitle);
        $post = new Post();
        $post->setTitle($request->getTitle());
        $post->setBody($request->getBody());
        $post->setUserId($request->getUserId());

        $response = new PostCreateResponse();
        try {

            /*
            $this->validate($post);

            $this->postRepository->save($post);
            */

            //return new CreatePostResponse($post);
            return $response;
        } catch (\Exception $e) {

            $response->setIsSuccess(false);
            $response->setErrorDescription($e->getMessage());

            return $response;
            //throw new InvalidPostDataException($e->getMessage());
        }
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
    
    protected function validate(Post $post): void
    {
        /*
        lazy()
            ->that($post->getTitle())->notBlank()->minLength(3)
            ->that($post->getBody())->notBlank()->minLength(10)
            ->verifyNow();
            */
    }    
}
