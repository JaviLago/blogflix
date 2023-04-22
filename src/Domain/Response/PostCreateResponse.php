<?php
namespace App\Domain\Response;

use App\Domain\Entity\Post;

class PostCreateResponse
{
    private Post $post;
    private bool $isSuccess; 
    private $errorDescription;

    public function __construct() {
        $this->isSuccess = false;
        $this->errorDescription = "Unknown";
    }
    
    public function getPost(): Post
    {
        return $this->post;
    }

    public function setPost(?Post $post): void
    {
        $this->post = $post;
    }

    public function getIsSuccess(): bool
    {
        return $this->isSuccess;
    }

    public function setIsSuccess(bool $isSuccess): void
    {
        if ($isSuccess){
            $this->errorDescription = null;    
        }
        $this->isSuccess = $isSuccess;
    }

    public function getErrorDescription(): string
    {
        return $this->errorDescription;
    }

    public function setErrorDescription(string $errorDescription): void
    {
        $this->errorDescription = $errorDescription;
    }
}
