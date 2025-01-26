<?php

namespace App\Repository;

use App\Entity\GameResult;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<GameResult>
 */
class GameResultRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GameResult::class);
    }

    /**
     * Checks if a transaction ID exists in the database.
     */
    public function doesTransactionIdExist(string $transactionId): bool
    {
        $qb = $this->createQueryBuilder('gr')
            ->select('count(gr.id)')
            ->where('gr.transactionId = :transactionId')
            ->setParameter('transactionId', $transactionId)
            ->getQuery();

        return (int) $qb->getSingleScalarResult() > 0;
    }
}
