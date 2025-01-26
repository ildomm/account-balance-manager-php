<?php

namespace App\Tests\Service;

use App\Entity\GameResult;
use App\Entity\User;
use App\Repository\GameResultRepository;
use App\Repository\UserRepository;
use App\Service\GameService;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;

class GameServiceTest extends TestCase
{
    private $userRepository;
    private $gameResultRepository;
    private $entityManager;
    private $gameService;

    protected function setUp(): void
    {
        // Mock dependencies
        $this->userRepository = $this->createMock(UserRepository::class);
        $this->gameResultRepository = $this->createMock(GameResultRepository::class);
        $this->entityManager = $this->createMock(EntityManagerInterface::class);

        // Initialize the GameService with mocked dependencies
        $this->gameService = new GameService(
            $this->userRepository,
            $this->gameResultRepository,
            $this->entityManager
        );
    }

    public function testSelectUser(): void
    {
        $user = new User();

        // Use reflection to set the ID since it's private/protected
        $reflection = new \ReflectionClass($user);
        $property = $reflection->getProperty('id');
        $property->setAccessible(true);
        $property->setValue($user, 1);

        $this->userRepository
            ->expects($this->once())
            ->method('findUserById')
            ->with(1)
            ->willReturn($user);

        $result = $this->gameService->selectUser(1);

        $this->assertSame($user, $result);
    }

    public function testTransactionIdExists(): void
    {
        $this->gameResultRepository
            ->expects($this->once())
            ->method('doesTransactionIdExist')
            ->with('tx123')
            ->willReturn(true);

        $exists = $this->gameService->transactionIdExists('tx123');

        $this->assertTrue($exists);
    }

    public function testInsertGameResult(): void
    {
        $gameResult = new GameResult();

        // Set the ID for testing
        $reflection = new \ReflectionClass($gameResult);
        $property = $reflection->getProperty('id');
        $property->setAccessible(true);
        $property->setValue($gameResult, 1);

        $this->entityManager
            ->expects($this->once())
            ->method('persist')
            ->with($gameResult);

        $this->entityManager
            ->expects($this->once())
            ->method('flush');

        $result = $this->gameService->insertGameResult($gameResult);

        $this->assertEquals(1, $result);
    }

    public function testUpdateUserBalance(): void
    {
        $this->userRepository
            ->expects($this->once())
            ->method('updateBalance')
            ->with(1, 100.50);

        $this->gameService->updateUserBalance(1, 100.50);
    }

    public function testWithTransaction(): void
    {
        $connectionMock = $this->createMock(\Doctrine\DBAL\Connection::class);

        $this->entityManager
            ->method('getConnection')
            ->willReturn($connectionMock);

        $connectionMock
            ->expects($this->once())
            ->method('beginTransaction');

        $this->entityManager
            ->expects($this->once())
            ->method('flush');

        $connectionMock
            ->expects($this->once())
            ->method('commit');

        $this->gameService->withTransaction(function () {
            // Simulate transactional operation
        });
    }


}
