<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221130215103 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE app_term_class ALTER custom_weapon_prof TYPE JSON USING custom_weapon_prof::json');
        $this->addSql('ALTER TABLE app_term_translation_class ALTER custom_weapon_prof TYPE JSON USING custom_weapon_prof::json');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE app_term_translation_class ALTER custom_weapon_prof TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE app_term_class ALTER custom_weapon_prof TYPE VARCHAR(255)');
    }
}
