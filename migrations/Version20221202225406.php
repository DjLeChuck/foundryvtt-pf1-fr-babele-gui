<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221202225406 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE app_term_spell ADD subschool VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE app_term_spell ADD types VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE app_term_translation_spell ADD subschool VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE app_term_translation_spell ADD types VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE app_term_spell DROP subschool');
        $this->addSql('ALTER TABLE app_term_spell DROP types');
        $this->addSql('ALTER TABLE app_term_translation_spell DROP subschool');
        $this->addSql('ALTER TABLE app_term_translation_spell DROP types');
    }
}
