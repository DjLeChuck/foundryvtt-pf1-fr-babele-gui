<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221204141626 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE app_term_item ADD actions JSON DEFAULT NULL');
        $this->addSql('ALTER TABLE app_term_item ADD context_notes JSON DEFAULT NULL');
        $this->addSql('ALTER TABLE app_term_translation_item ADD actions JSON DEFAULT NULL');
        $this->addSql('ALTER TABLE app_term_translation_item ADD context_notes JSON DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE app_term_item DROP actions');
        $this->addSql('ALTER TABLE app_term_item DROP context_notes');
        $this->addSql('ALTER TABLE app_term_translation_item DROP actions');
        $this->addSql('ALTER TABLE app_term_translation_item DROP context_notes');
    }
}
