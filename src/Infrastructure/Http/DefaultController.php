<?php

#namespace App\Controller;
namespace App\Infrastructure\Http;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Infrastructure\Repository\PostRepository;
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

        var_dump($posts);

        return $this->render('web/listPosts.html.twig', [
            'controller_name' => 'DefaultController',
            'posts' => $posts,
        ]);
    }


    #[Route('/posts/{id}', name: 'app_post', condition: "params['id'] < 1000")]
    public function postsDetails(GetPostDetailsUseCase $getPostDetailsUseCase, PostRepository $postRepository, int $id): Response
    {
        $post = $getPostDetailsUseCase($postRepository, $id);

        //var_dump("asdsf: " . $id);
        var_dump($post?->getTitle());
        var_dump($post?->getBody());
        var_dump($post?->getUserId());
        return $this->render('web/postDetails.html.twig', [
            'controller_name' => 'DefaultController',
            'post' => $post,
        ]);
    }


    

}
