<?php

namespace App\Application;
use App\Domain\Entity\Post;
use App\Domain\Interfaces\PostRepositoryInterface;

class GetPostsUseCase
{
    public function __invoke(PostRepositoryInterface $postRepository, ?string $filterByTitle){
        return $postRepository->findAllWithFilter($filterByTitle);
    }
}
