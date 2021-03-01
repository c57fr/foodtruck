<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210216153644 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE trouver CHANGE adresse adresse VARCHAR(255) NOT NULL, CHANGE jour jour VARCHAR(255) DEFAULT NULL, CHANGE debut debut VARCHAR(255) DEFAULT NULL, CHANGE fin fin VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE trouver CHANGE adresse adresse VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE jour jour TIME DEFAULT NULL, CHANGE debut debut TIME DEFAULT NULL, CHANGE fin fin TIME DEFAULT NULL');
    }
}
