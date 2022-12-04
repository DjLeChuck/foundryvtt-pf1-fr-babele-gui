<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221204102939 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE app_term_class ADD custom_armor_prof JSON DEFAULT NULL');
        $this->addSql('ALTER TABLE app_term_race ADD custom_languages JSON DEFAULT NULL');
        $this->addSql('ALTER TABLE app_term_translation_class ADD custom_armor_prof JSON DEFAULT NULL');
        $this->addSql('ALTER TABLE app_term_translation_race ADD custom_languages JSON DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE app_term_translation_race DROP custom_languages');
        $this->addSql('ALTER TABLE app_term_translation_class DROP custom_armor_prof');
        $this->addSql('ALTER TABLE app_term_class DROP custom_armor_prof');
        $this->addSql('ALTER TABLE app_term_race DROP custom_languages');
    }
}
