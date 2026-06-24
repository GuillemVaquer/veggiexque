<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260624204615 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE province ADD search_name VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE restaurant ADD search_name VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE restaurant ADD search_address VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE province DROP search_name');
        $this->addSql('ALTER TABLE restaurant DROP search_name');
        $this->addSql('ALTER TABLE restaurant DROP search_address');
    }
}
