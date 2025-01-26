<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250126092445FixGameResults extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Fix game_results table';
    }

    public function up(Schema $schema): void
    {
        # Change created_at to TIMESTAMP for more precise timing
        $this->addSql('ALTER TABLE game_results 
            ALTER COLUMN created_at TYPE TIMESTAMP(6) WITHOUT TIME ZONE;');

        # Add UNIQUE constraint to transaction_id to prevent duplicates
        $this->addSql('ALTER TABLE game_results 
            ADD CONSTRAINT game_results_transaction_id_key UNIQUE (transaction_id);');
    }

    public function down(Schema $schema): void
    {
        # Remove constraints
        $this->addSql('ALTER TABLE game_results 
            DROP CONSTRAINT IF EXISTS game_results_transaction_id_key;');

        # Revert created_at back to DATE
        $this->addSql('ALTER TABLE game_results 
            ALTER COLUMN created_at TYPE DATE;');
    }
}
