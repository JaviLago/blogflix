<?php

namespace App\Infrastructure\Http;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Infrastructure\Repository\PostRepository;
use App\Infrastructure\Repository\UserRepository;
use App\Application\GetPostsUseCase;
use App\Application\GetPostDetailsUseCase;
use App\Application\CreatePostUseCase;
use App\Infrastructure\Http\Form\PostType;
use App\Domain\Request\PostCreateRequest;


class PostsController extends AbstractController
{

    #[Route('', name: 'app_index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->redirectToRoute('app_posts');
    }

    #[Route('/error/', name: 'app_error', methods: ['GET'])]
    public function errorPage(): Response
    {
        return $this->render('web/error.html.twig');
    }

    #[Route('/posts/', name: 'app_posts', methods: ['GET'])]
    public function posts(GetPostsUseCase $getPostsUseCase, PostRepository $postRepository, UserRepository $userRepository): Response
    {        
        $posts = $getPostsUseCase($postRepository, $userRepository, null);
        
        return $this->render('web/listPosts.html.twig', [
            'posts' => $posts,
        ]);       
    }

    #[Route('/posts/{id}', name: 'app_post_details', condition: "params['id'] < 100", methods: ['GET'])]
    public function postsDetails(GetPostDetailsUseCase $getPostDetailsUseCase, PostRepository $postRepository, UserRepository $userRepository, int $id): Response
    {
        $postDetail = $getPostDetailsUseCase($postRepository, $userRepository, $id);
        
        return $this->render('web/postDetails.html.twig', [
            'postDetail' => $postDetail,
        ]);
    }

    #[Route('/posts/create', name: 'app_post_create', methods: ['GET', 'POST'])]
    public function postsCreate(Request $request, CreatePostUseCase $createPostUseCase, PostRepository $postRepository): Response
    {
        $form = $this->createForm(PostType::class);
        $form->handleRequest($request);


        if ($form->isSubmitted() and $form->isValid()) {

            try {
                $userId = 1; // Simulate user loged "id" :)
                $title = $form->get('title')->getData();
                $body = $form->get('body')->getData();

                $postCreateRequest = new PostCreateRequest($title, $body, $userId);
 
                $result = $createPostUseCase($postRepository, $postCreateRequest);
                
                return $this->render('web/postCreateResult.html.twig', [
                    'success' => $result->getIsSuccess(),
                    'result' =>  ($result->getIsSuccess() ? 'Save successful' : $result->getErrorDescription()),
                ]);
            } catch (\Exception $dataException) {
                return $this->render('web/postCreateResult.html.twig', [
                    'success' => false,
                    'result' => "ERROR: " . $dataException->getMessage(),
                ]);
            }
        }

        return $this->render('web/postCreate.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
