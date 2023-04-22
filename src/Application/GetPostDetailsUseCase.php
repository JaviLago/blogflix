<?php

namespace App\Application;

use App\Domain\Entity\Post;
use App\Domain\Interfaces\PostRepositoryInterface;

class GetPostDetailsUseCase
{
    public function __invoke(PostRepositoryInterface $postRepository, int $id): ?Post{

        // debería traerme también el author
        return $postRepository->findOneById($id);
    }
}
