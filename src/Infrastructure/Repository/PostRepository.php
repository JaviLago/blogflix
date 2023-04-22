<?php

namespace App\Infrastructure\Repository;

use App\Domain\Interfaces\PostRepositoryInterface;
use App\Domain\Entity\Post;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use PhpParser\Node\Stmt\TryCatch;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

use function PHPUnit\Framework\throwException;

/**
 * @extends ServiceEntityRepository<Posts>
 *
 * @method Post|null find($id, $lockMode = null, $lockVersion = null)
 * @method Post|null findOneBy(array $criteria, array $orderBy = null)
 * @method Post[]    findAll()
 * @method Post[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostRepository extends ServiceEntityRepository implements PostRepositoryInterface
{
    public function __construct(ManagerRegistry $registry, Utils $utils)
    {
        parent::__construct($registry, Posts::class);

        $this->encoders = [new XmlEncoder(), new JsonEncoder()];
        $this->normalizers = [new ObjectNormalizer()];
        $this->serializer = new Serializer($this->normalizers, $this->encoders);        
        $this->utils = $utils;
    }

    public function save(Post $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
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
            $curlResult =  $this->utils->curl("https://jsonplaceholder.typicode.com/posts/".$id);

            $serializer = new Serializer([new ObjectNormalizer()], [new JsonEncoder()]);
            $post = $serializer->deserialize($curlResult->response, Post::class, 'json');
            
            return $post;
        } catch (\Throwable $th) {
            // TODO - insert exception log!
            throwException($th);
        }
    }

    public function findAllWithFilter(?string $filterByTitle): Array{

        try {
            $curlResult =  $this->utils->curl("https://jsonplaceholder.typicode.com/posts");

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
                $posts[] = $post;
            }
           
            return $posts;

        } catch (\Throwable $th) {
            // TODO - insert exception log!
            throwException($th);
        }
    }
}
