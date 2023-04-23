<?php

namespace App\Test\Infrastructure\Repository;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use App\Domain\Entity\Post;

class BlogListTest extends WebTestCase
{   
    private KernelBrowser $client;
    private string $path = '/posts/';
    private string $pathCreate = '/posts/create';

    public function testPageLoad(){
        $this->client->request('GET', $this->path);
        //$this->client->followRedirect();

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Post list');
    }

    public function testPageCreatePostLoad(){
        $this->client->request('GET', $this->pathCreate);
        
        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Create Post');
    }

    protected function setUp(): void
    {
        $this->client = static::createClient();
    }

    /*
    Note: add more pages...
    */
}
