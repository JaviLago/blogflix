<?php
namespace App\Domain\Response;

use App\Domain\Entity\Post;
use App\Domain\Entity\User;

class PostDetailResponse
{
    private Post $post;
    private User $author;

    public function __construct(Post $post, User $author) {
        $this->post = $post;
        $this->author = $author;
    }
    
    public function getPost(): Post
    {
        return $this->post;
    }

    public function getAuthor(): User
    {
        return $this->author;
    }
}
