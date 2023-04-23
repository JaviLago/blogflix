<?php

namespace App\Application;

use App\Domain\Response\PostDetailResponse;
use App\Domain\Interfaces\PostRepositoryInterface;
use App\Domain\Interfaces\UserRepositoryInterface;

class GetPostDetailsUseCase
{

    /**
     * @param PostRepositoryInterface $postRepository
     * @param UserRepositoryInterface $userRepository
     * @param int $id
     * @return PostDetailResponse|null
     */
    public function __invoke(PostRepositoryInterface $postRepository, UserRepositoryInterface $userRepository, int $id): ?PostDetailResponse{

        $post = $postRepository->findOneById($id);
        $author = $userRepository->findOneById($post->getUserId());
        $result = new PostDetailResponse($post, $author);
        return $result;
    }
}
