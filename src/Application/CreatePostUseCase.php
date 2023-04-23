<?php

namespace App\Application;

use App\Domain\Entity\Post;
use App\Domain\Interfaces\PostRepositoryInterface;

use App\Domain\Request\PostCreateRequest;
use App\Domain\Response\PostCreateResponse;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Constraints as Assert;

class CreatePostUseCase
{
    public function __invoke(PostRepositoryInterface $postRepository,  PostCreateRequest $request) : PostCreateResponse{
        
        $post = new Post();
        $post->setTitle($request->getTitle());
        $post->setBody($request->getBody());
        $post->setUserId($request->getUserId());

        $response = new PostCreateResponse();
        try {

            /**
             * Note: We can put these "assets" on the attributes of the entities. It's just an example of validator :)
             */
            $validator = Validation::createValidatorBuilder()
                ->enableAnnotationMapping() 
                ->addMethodMapping('loadValidatorMetadata')
                ->getValidator();

            
            $constraints = new Assert\Collection([
                'userId' => [
                    new Assert\NotNull()
                ],
                'title' => [
                    new Assert\NotBlank(),
                    new Assert\Length([
                        'min' => 5,
                        'max' => 100,
                    ]),
                ],
                'body' => [
                    new Assert\NotBlank(),
                    new Assert\Length([
                        'min' => 10,
                        'max' => 255,
                    ]),
                ],
            ]);
             
            $errors = $validator->validate([    'userId' => $request->getUserId(),
                                                'title' => $request->getTitle(),
                                                'body' => $request->getBody(),
                                            ], $constraints);

            if (count($errors) > 0) {
                $response->setIsSuccess(false);
                $response->setErrorDescription((string) $errors);
                return $response;
            }

            $postRepository->save($post, true);
            $response->setIsSuccess(true);
            return $response;

        } catch (\Exception $e) {

            $response->setIsSuccess(false);
            $response->setErrorDescription($e->getMessage());

            return $response;            
        }
    }
}
