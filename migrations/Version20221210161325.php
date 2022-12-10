<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221210161325 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE app_term_bestiary ADD img VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE app_term_bestiary ADD token VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE app_term_translation_bestiary ADD img VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE app_term_translation_bestiary ADD token VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE app_term_translation_bestiary DROP img');
        $this->addSql('ALTER TABLE app_term_translation_bestiary DROP token');
        $this->addSql('ALTER TABLE app_term_bestiary DROP img');
        $this->addSql('ALTER TABLE app_term_bestiary DROP token');
    }
}
