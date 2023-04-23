<?php
namespace App\Domain\Request;

/**
 * Class for post creation request
 */
class PostCreateRequest
{
    private string $title;
    private string $body;
    private int $userId;

    public function __construct(?string $title, ?string $body, ?int $userId) {
        $this->title = ($title != null ? $title: "");
        $this->body = ($body != null ? $body: "");
        $this->userId = $userId;
    }
    
    public function getTitle(): string
    {
        return $this->title;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }
}
