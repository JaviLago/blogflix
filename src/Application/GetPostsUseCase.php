<?php

namespace App\Application;
use App\Domain\Interfaces\PostRepositoryInterface;
use App\Domain\Interfaces\UserRepositoryInterface;
use App\Domain\Response\PostDetailResponse;

class GetPostsUseCase
{
    /**
     * @param PostRepositoryInterface $postRepository
     * @param UserRepositoryInterface $userRepository
     * @param ?string $filterByTitle
     * @return Array
     */
    public function __invoke(PostRepositoryInterface $postRepository, UserRepositoryInterface $userRepository, ?string $filterByTitle): Array{
        // Result array
        $result = [];
        $postList = $postRepository->findAllWithFilter($filterByTitle);

        foreach ($postList as $post) {
            $author = $userRepository->findOneById($post->getUserId());
            $result[] = new PostDetailResponse($post, $author);      
        }
        
        return $result;
    }
}
