<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221130190030 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE app_term_spell (id INT NOT NULL, actions JSON DEFAULT NULL, learned_at_classes JSON DEFAULT NULL, learned_at_domains JSON DEFAULT NULL, learned_at_sub_domains JSON DEFAULT NULL, learned_at_bloodlines JSON DEFAULT NULL, materials VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE app_term_translation_spell (id INT NOT NULL, actions JSON DEFAULT NULL, learned_at_classes JSON DEFAULT NULL, learned_at_domains JSON DEFAULT NULL, learned_at_sub_domains JSON DEFAULT NULL, learned_at_bloodlines JSON DEFAULT NULL, materials VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE app_term_spell ADD CONSTRAINT FK_B3161979BF396750 FOREIGN KEY (id) REFERENCES app_term (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE app_term_translation_spell ADD CONSTRAINT FK_99647ECBBF396750 FOREIGN KEY (id) REFERENCES app_term_translation (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE app_term_spell DROP CONSTRAINT FK_B3161979BF396750');
        $this->addSql('ALTER TABLE app_term_translation_spell DROP CONSTRAINT FK_99647ECBBF396750');
        $this->addSql('DROP TABLE app_term_spell');
        $this->addSql('DROP TABLE app_term_translation_spell');
    }
}
