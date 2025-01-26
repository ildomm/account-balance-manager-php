<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250126092004Indexes extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add indexes to game_results table';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE INDEX IF NOT EXISTS game_results_pxt_game_status ON game_results (game_status);');
        $this->addSql('CREATE INDEX IF NOT EXISTS game_results_pxt_transaction_source ON game_results (transaction_source);');
        $this->addSql('CREATE INDEX IF NOT EXISTS game_results_pxt_amount ON game_results (amount);');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IF EXISTS game_results_pxt_game_status;');
        $this->addSql('DROP INDEX IF EXISTS game_results_pxt_transaction_source;');
        $this->addSql('DROP INDEX IF EXISTS game_results_pxt_amount;');
    }
}
