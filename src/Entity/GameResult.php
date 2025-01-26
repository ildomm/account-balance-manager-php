<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GameResultRepository")
 * @ORM\Table(
 *     name="game_results",
 *     indexes={
 *         @ORM\Index(name="game_results_pxt_amount", columns={"amount"}),
 *         @ORM\Index(name="game_results_pxt_game_status", columns={"game_status"}),
 *         @ORM\Index(name="game_results_pxt_transaction_source", columns={"transaction_source"})
 *     },
 *     uniqueConstraints={
 *         @ORM\UniqueConstraint(name="game_results_transaction_id_key", columns={"transaction_id"})
 *     }
 * )
 */
class GameResult
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="bigint")
     */
    private $id;

    /**
     * @ORM\Column(type="bigint")
     */
    private $userId;

    /**
     * @ORM\Column(type="game_statuses")
     */
    private $gameStatus;

    /**
     * @ORM\Column(type="transaction_sources")
     */
    private $transactionSource;

    /**
     * @ORM\Column(type="string")
     */
    private $transactionId;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $amount;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    // Getters and setters for each property

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setUserId(int $userId): self
    {
        $this->userId = $userId;

        return $this;
    }

    public function getUserId(): ?int
    {
        return $this->userId;
    }

    public function setGameStatus(string $gameStatus): self
    {
        $this->gameStatus = $gameStatus;

        return $this;
    }

    public function getGameStatus(): ?string
    {
        return $this->gameStatus;
    }

    public function setTransactionSource(string $transactionSource): self
    {
        $this->transactionSource = $transactionSource;

        return $this;
    }

    public function getTransactionSource(): ?string
    {
        return $this->transactionSource;
    }

    public function setTransactionId(string $transactionId): self
    {
        $this->transactionId = $transactionId;

        return $this;
    }

    public function getTransactionId(): ?string
    {
        return $this->transactionId;
    }

    public function setAmount(string $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getAmount(): ?string
    {
        return $this->amount;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }
}
