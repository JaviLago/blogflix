<?php

namespace App\Application;
use App\Domain\Interfaces\PostRepositoryInterface;
use App\Domain\Interfaces\UserRepositoryInterface;
use App\Domain\Response\PostDetailResponse;
use App\Domain\Entity\User;
class GetPostsUseCase
{
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
