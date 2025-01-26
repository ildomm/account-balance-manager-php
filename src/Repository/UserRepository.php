<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<User>
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * Fetches a user by their ID.
     */
    public function findUserById(int $userId): ?User
    {
        return $this->find($userId);
    }

    /**
     * Updates the user's balance.
     */
    public function updateBalance(int $userId, float $balance): void
    {
        $qb = $this->createQueryBuilder('u')
            ->update()
            ->set('u.balance', ':balance')
            ->where('u.id = :id')
            ->setParameter('balance', $balance)
            ->setParameter('id', $userId)
            ->getQuery();

        $qb->execute();
    }
}
