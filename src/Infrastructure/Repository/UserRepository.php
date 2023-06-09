<?php

namespace App\Infrastructure\Repository;

use App\Domain\Interfaces\UserRepositoryInterface;
use App\Domain\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use App\Infrastructure\Repository\Utils;

/**
 * @extends ServiceEntityRepository<Posts>
 *
 * @method User|null findOneById($id = null)
 */
class UserRepository extends ServiceEntityRepository implements UserRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function findOneById(int $id): ?User
    {        
        try {
            $utils = new Utils();
            $curlResult =  $utils->curl("https://jsonplaceholder.typicode.com/users/".$id);
            $serializer = new Serializer([new ObjectNormalizer()], [new JsonEncoder()]);
            $user = $serializer->deserialize($curlResult->response, User::class, 'json');
            return $user;
        } catch (\Throwable $th) {
            // TODO - insert exception log!
            //throwException($th);
            return null;
        }
    }
}
