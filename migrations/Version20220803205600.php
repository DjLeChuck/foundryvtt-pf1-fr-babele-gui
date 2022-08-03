<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220803205600 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE app_term_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE app_term_translation_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE app_term (id INT NOT NULL, name VARCHAR(255) NOT NULL, description TEXT NOT NULL, pack VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX term_name_idx ON app_term (name)');
        $this->addSql('CREATE INDEX term_pack_idx ON app_term (pack)');
        $this->addSql('CREATE TABLE app_term_translation (id INT NOT NULL, term_id INT NOT NULL, name VARCHAR(255) NOT NULL, description TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D1B45234E2C35FC ON app_term_translation (term_id)');
        $this->addSql('CREATE INDEX term_translation_name_idx ON app_term_translation (name)');
        $this->addSql('ALTER TABLE app_term_translation ADD CONSTRAINT FK_D1B45234E2C35FC FOREIGN KEY (term_id) REFERENCES app_term (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE app_term_translation DROP CONSTRAINT FK_D1B45234E2C35FC');
        $this->addSql('DROP SEQUENCE app_term_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE app_term_translation_id_seq CASCADE');
        $this->addSql('DROP TABLE app_term');
        $this->addSql('DROP TABLE app_term_translation');
    }
}
