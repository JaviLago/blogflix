<?php

namespace App\Infrastructure\ApiRest;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Infrastructure\Repository\PostRepository;
use App\Infrastructure\Repository\UserRepository;
use App\Application\GetPostsUseCase;
use App\Application\GetPostDetailsUseCase;
use App\Application\CreatePostUseCase;
use App\Infrastructure\Http\Form\PostType;
use App\Domain\Request\PostCreateRequest;
#[Route('/v1', name: 'app_api_v1')]
class ApiController extends AbstractController
{
    #[Route('/post', name: 'app_api_post', methods: ['GET'])]
    public function postList(GetPostsUseCase $getPostsUseCase, PostRepository $postRepository, UserRepository $userRepository): Response
    {
        $posts = $getPostsUseCase($postRepository, $userRepository, null);

        return $this->json(
            $posts,
            headers: ['Content-Type' => 'application/json;charset=UTF-8']
        );
    }


    #[Route('/post/create', name: 'app_api_post_create', methods: ['POST'])]
    public function postCreate(): Response
    {
        return $this->render('api/index.html.twig', [
            'controller_name' => 'ApiController',
        ]);
    }
}
