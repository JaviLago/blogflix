<?php

#namespace App\Controller;
namespace App\Infrastructure\Http;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Infrastructure\Repository\PostRepository;
use App\Infrastructure\Repository\UserRepository;
use App\Application\GetPostsUseCase;
use App\Application\GetPostDetailsUseCase;

class DefaultController extends AbstractController
{

    #[Route('', name: 'app_index')]
    public function index(): Response
    {
        return $this->redirectToRoute('app_posts');
    }

    #[Route('/error/', name: 'app_error')]
    public function errorPage(): Response
    {
        return $this->render('web/error.html.twig');
    }

    #[Route('/posts/', name: 'app_posts')]
    public function posts(GetPostsUseCase $getPostsUseCase, PostRepository $postRepository): Response
    {        
        $posts = $getPostsUseCase($postRepository, null);
     
        return $this->render('web/listPosts.html.twig', [
            'posts' => $posts,
        ]);       
    }

    #[Route('/posts/{id}', name: 'app_post_details', condition: "params['id'] < 1000")]
    public function postsDetails(GetPostDetailsUseCase $getPostDetailsUseCase, PostRepository $postRepository, UserRepository $userRepository, int $id): Response
    {
        $postDetail = $getPostDetailsUseCase($postRepository, $userRepository, $id);
        
        return $this->render('web/postDetails.html.twig', [
            'controller_name' => 'DefaultController',
            'postDetail' => $postDetail,
        ]);
    }

    #[Route('/posts/create', name: 'app_post_create')]
    public function postsCreate(GetPostDetailsUseCase $getPostDetailsUseCase, PostRepository $postRepository, UserRepository $userRepository, int $id): Response
    {
        $postDetail = $getPostDetailsUseCase($postRepository, $userRepository, $id);

        return $this->render('web/postDetails.html.twig', [
            'controller_name' => 'DefaultController',
            'postDetail' => $postDetail,
        ]);
    }


    

}
