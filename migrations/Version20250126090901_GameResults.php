<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250126090901GameResults extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create enum types for game statuses and transaction sources, and a new game_results table';
    }

    public function up(Schema $schema): void
    {
        // Create ENUM type 'game_statuses'
        $this->addSql('DROP TYPE IF EXISTS game_statuses');
        $this->addSql("CREATE TYPE game_statuses AS ENUM ('win', 'lose')");

        // Create ENUM type 'transaction_sources'
        $this->addSql('DROP TYPE IF EXISTS transaction_sources');
        $this->addSql("CREATE TYPE transaction_sources AS ENUM ('game', 'server', 'payment')");

        // Create 'game_results' table
        $this->addSql('
            CREATE TABLE IF NOT EXISTS game_results (
                id BIGSERIAL PRIMARY KEY,
                user_id BIGINT NOT NULL,
                game_status game_statuses NOT NULL,
                transaction_source transaction_sources NOT NULL,
                transaction_id VARCHAR NOT NULL,
                amount DECIMAL(10, 2) NOT NULL,
                created_at DATE NOT NULL
            )
        ');
    }

    public function down(Schema $schema): void
    {
        // Drop 'game_results' table
        $this->addSql('DROP TABLE IF EXISTS game_results');

        // Drop enum types
        $this->addSql('DROP TYPE IF EXISTS game_statuses');
        $this->addSql('DROP TYPE IF EXISTS transaction_sources');
    }
}
