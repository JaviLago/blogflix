<?php

namespace App\Infrastructure\ApiRest;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Infrastructure\Repository\PostRepository;
use App\Infrastructure\Repository\UserRepository;
use App\Application\GetPostsUseCase;
use App\Application\CreatePostUseCase;
use App\Domain\Request\PostCreateRequest;
use App\Domain\Response\PostCreateResponse;
use OpenApi\Attributes as OA;

use function PHPSTORM_META\type;

#[Route('/api/v1', name: 'app_api_v1')]
class ApiController extends AbstractController
{
    #[Route('/post', name: 'app_api_post', methods: ['GET'])]
    #[OA\Tag(name: 'Post')]
    #[OA\Get(summary: 'Get list of posts')]
    #[OA\Response(
        response: 200,
        description: 'Successful operation',
        content: new OA\JsonContent(type: 'Array', example: [
            [
                  "post" => [
                     "id" => 1, 
                     "title" => "sunt aut facere repellat provident occaecati excepturi optio reprehenderit", 
                     "body" => "quia et suscipit
                                suscipit recusandae consequuntur expedita et cum
                                reprehenderit molestiae ut ut quas totam
                                nostrum rerum est autem sunt rem eveniet architecto", 
                                            "userId" => 1 
                                        ], 
                                        "author" => [
                                                "id" => 1, 
                                                "name" => "Leanne Graham", 
                                                "userName" => "Bret", 
                                                "email" => "Sincere@april.biz", 
                                                "phone" => "1-770-736-8031 x56442", 
                                                "website" => "hildegard.org" 
                                            ] 
                                    ], 
                                    [
                           "post" => [
                              "id" => 2, 
                              "title" => "qui est esse", 
                              "body" => "est rerum tempore vitae
                                        sequi sint nihil reprehenderit dolor beatae ea dolores neque
                                        fugiat blanditiis voluptate porro vel nihil molestiae ut reiciendis
                                        qui aperiam non debitis possimus qui neque nisi nulla", 
                              "userId" => 1 
                           ], 
                           "author" => [
                                 "id" => 1, 
                                 "name" => "Leanne Graham", 
                                 "userName" => "Bret", 
                                 "email" => "Sincere@april.biz", 
                                 "phone" => "1-770-736-8031 x56442", 
                                 "website" => "hildegard.org" 
                              ] 
                        ] 
         ])  
    )]
    #[OA\Response(
        response: 400,
        description: 'Error!')]
    public function postList(GetPostsUseCase $getPostsUseCase, PostRepository $postRepository, UserRepository $userRepository): Response
    {       
        try{
            $posts = $getPostsUseCase($postRepository, $userRepository, null);
            
            return $this->json(
                $posts,
                200,
                headers: ['Content-Type' => 'application/json;charset=UTF-8']
            );
        }
        catch(\Exception $e){
            return $this->json(
                $e,
                400, // TODO: Add custom status code
                headers: ['Content-Type' => 'application/json;charset=UTF-8']
            );
        }
        
    }

    #[Route('/post/create', name: 'app_api_post_create', methods: ['POST'])]
    #[OA\Tag(name: 'Post')]
    #[OA\Post(summary: 'Create a post')]
    #[OA\RequestBody(description: 'Post object that needs to be created', required: false)]
    #[OA\Parameter(
        name: 'title',
        description: 'Post title',
        in: 'query',
        required: true,
        schema: new OA\Schema(type: 'string')
    )]
    #[OA\Parameter(
        name: 'body',
        description: 'Post body',
        in: 'query',
        required: true,
        schema: new OA\Schema(type: 'string')
    )]
    #[OA\Parameter(
        name: 'userId',
        description: 'Author id',
        in: 'query',
        required: true,
        schema: new OA\Schema(type: 'string')
    )]
    #[OA\Response(
        response: 200,
        description: 'Successful operation',
        content: new OA\JsonContent(type: PostCreateResponse::class, example: ['isSuccess' => true])  
    )]
    #[OA\Response(
        response: 400,
        description: 'Error operation',
        content: new OA\JsonContent(type: PostCreateResponse::class, example: ['isSuccess' => false, 'errorDescription' => 'Error description...'])
        
    )]
    public function postCreate(Request $request, CreatePostUseCase $createPostUseCase, PostRepository $postRepository): Response
    {
        try{
            $title = $request->query->get('title');
            $body =$request->query->get('body');
            $userId = $request->query->get('userId');
            $postCreateRequest = new PostCreateRequest($title, $body, $userId);

            $result = $createPostUseCase($postRepository, $postCreateRequest);

            // 201 es el creado
            return $this->json(
                $result,
                ($result->getIsSuccess() ? 201 : 400), 
                headers: ['Content-Type' => 'application/json;charset=UTF-8']
            );  
        }
        catch(\Exception $e){
            return $this->json(
                $e,
                400, // TODO: Add custom status code
                headers: ['Content-Type' => 'application/json;charset=UTF-8']
            );
        }
    }
}
