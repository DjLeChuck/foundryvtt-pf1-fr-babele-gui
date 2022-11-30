<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221130223043 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE app_term_feat (id INT NOT NULL, actions JSON DEFAULT NULL, context_notes JSON DEFAULT NULL, custom_weapon_prof JSON DEFAULT NULL, tags JSON DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE app_term_translation_feat (id INT NOT NULL, actions JSON DEFAULT NULL, context_notes JSON DEFAULT NULL, custom_weapon_prof JSON DEFAULT NULL, tags JSON DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE app_term_feat ADD CONSTRAINT FK_7523BCD6BF396750 FOREIGN KEY (id) REFERENCES app_term (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE app_term_translation_feat ADD CONSTRAINT FK_686F9A2DBF396750 FOREIGN KEY (id) REFERENCES app_term_translation (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE app_term_feat DROP CONSTRAINT FK_7523BCD6BF396750');
        $this->addSql('ALTER TABLE app_term_translation_feat DROP CONSTRAINT FK_686F9A2DBF396750');
        $this->addSql('DROP TABLE app_term_feat');
        $this->addSql('DROP TABLE app_term_translation_feat');
    }
}
