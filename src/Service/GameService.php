<?php

namespace App\Service;

use App\Entity\User;
use App\Entity\GameResult;
use App\Repository\UserRepository;
use App\Repository\GameResultRepository;
use Doctrine\ORM\EntityManagerInterface;

class GameService
{
    private UserRepository $userRepository;
    private GameResultRepository $gameResultRepository;
    private EntityManagerInterface $em;

    public function __construct(
        UserRepository $userRepository,
        GameResultRepository $gameResultRepository,
        EntityManagerInterface $em
    ) {
        $this->userRepository = $userRepository;
        $this->gameResultRepository = $gameResultRepository;
        $this->em = $em;
    }

    public function withTransaction(callable $fn): void
    {
        $this->em->getConnection()->beginTransaction();
        try {
            $fn();
            $this->em->flush();
            $this->em->getConnection()->commit();
        } catch (\Throwable $e) {
            $this->em->getConnection()->rollBack();
            throw $e;
        }
    }

    public function selectUser(int $userId): ?User
    {
        return $this->userRepository->findUserById($userId);
    }

    public function transactionIdExists(string $transactionId): bool
    {
        return $this->gameResultRepository->doesTransactionIdExist($transactionId);
    }

    public function insertGameResult(GameResult $gameResult): int
    {
        $this->em->persist($gameResult);
        $this->em->flush();

        return $gameResult->getId();
    }

    public function updateUserBalance(int $userId, float $balance): void
    {
        $this->userRepository->updateBalance($userId, $balance);
    }
}
