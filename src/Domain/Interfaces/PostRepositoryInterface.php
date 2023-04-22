<?php
namespace App\Domain\Interfaces;

use App\Domain\Entity\Post;

interface PostRepositoryInterface
{
    /**
     * @param Post $post
     * @param bool $flush
     * @return void
     */
    public function save(Post $post, bool $flush = false): void;

    /**
     * @param int $id
     * @return Post|null
     */
    public function findOneById(int $id): ?Post;

    /**
     * @param string $filterByTitle
     * @return Post[]
     */
    public function findAllWithFilter(?string $filterByTitle): array;
}
