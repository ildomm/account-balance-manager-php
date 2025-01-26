<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250126092249PopulateUsers extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Populate the users table with some test data';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('TRUNCATE users CASCADE;');
        $this->addSql('ALTER SEQUENCE users_id_seq RESTART WITH 1;');
        $this->addSql('INSERT INTO users (id, balance, created_at)
                            VALUES
                            (1, 0, NOW()),
                                (2, 0, NOW()),
                                (3, 0, NOW()),
                                (4, 0, NOW()),
                                (5, 0, NOW()),
                                (6, 0, NOW()),
                                (7, 0, NOW()),
                                (8, 0, NOW()),
                                (9, 0, NOW());');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('TRUNCATE users CASCADE;');
    }
}
