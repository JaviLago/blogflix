<?php
namespace App\Domain\Interfaces;

use App\Domain\Entity\User;

interface UserRepositoryInterface
{
    /**
     * @param int $id
     * @return User|null
     */
    public function findOneById(int $id): ?User;
}
