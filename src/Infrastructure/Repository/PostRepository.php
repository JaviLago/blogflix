<?php

namespace App\Infrastructure\Repository;

use App\Domain\Interfaces\PostRepositoryInterface;
use App\Domain\Entity\Post;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use App\Infrastructure\Repository\Utils;

/**
 * @extends ServiceEntityRepository<Posts>
 *
 * @method Post|null find($id, $lockMode = null, $lockVersion = null)
 * @method Post|null findOneBy(array $criteria, array $orderBy = null)
 * @method Post[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostRepository extends ServiceEntityRepository implements PostRepositoryInterface
{
    

    public function __construct(ManagerRegistry $registry)
    {   
        parent::__construct($registry, Post::class);
    }

    public function save(Post $entity, bool $flush = false): void
    {
        /**
         * Note: At this point it could be saved to DB using doctrine or a call to an external API... :)
         */
        /*
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
        */
    }

    public function remove(Post $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findOneById(int $id): ?Post
    {        
        try {
            $utils = new Utils();
            $curlResult =  $utils->curl("https://jsonplaceholder.typicode.com/posts/".$id);

            $serializer = new Serializer([new ObjectNormalizer()], [new JsonEncoder()]);
            $post = $serializer->deserialize($curlResult->response, Post::class, 'json');
            
            return $post;
        } catch (\Throwable $th) {
            // TODO - insert exception log!
            //throwException($th);
            return null;
        }
    }

    public function findAllWithFilter(?string $filterByTitle): Array{

        try {
            $utils = new Utils();
            $curlResult =  $utils->curl("https://jsonplaceholder.typicode.com/posts");

            // Decode curl result
            $decodedResult = json_decode($curlResult->response, true);
    
            // Result array
            $posts = [];
    
            // Serializer instance
            $serializer = new Serializer([new ObjectNormalizer()], [new JsonEncoder()]);
    
            foreach ($decodedResult as $element) {
                $post = new Post();
                // Deserialize data into "Post" object
                $post = $serializer->deserialize(json_encode($element), Post::class, 'json');

                /* NOTE: Here we could put something more elaborate... it's just an example
                 */
                if ($filterByTitle == null || strpos($post->getTitle(), $filterByTitle) !== false){
                    $posts[] = $post;
                }               
            }
           
            return $posts;

        } catch (\Throwable $th) {
            // TODO - insert exception log!
            return [];
        }
    }
}
