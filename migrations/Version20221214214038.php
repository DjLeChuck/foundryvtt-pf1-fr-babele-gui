<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221214214038 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE app_term_journal_entries DROP CONSTRAINT fk_f168eef3478e8802');
        $this->addSql('ALTER TABLE app_term_journal_entries DROP CONSTRAINT fk_f168eef36a86e4fb');
        $this->addSql('ALTER TABLE app_term_translation_journal_entries DROP CONSTRAINT fk_c6d1a9a5478e8802');
        $this->addSql('ALTER TABLE app_term_translation_journal_entries DROP CONSTRAINT fk_c6d1a9a56a86e4fb');
        $this->addSql('DROP TABLE app_term_journal_entries');
        $this->addSql('DROP TABLE app_term_translation_journal_entries');
        $this->addSql('ALTER TABLE app_term_journal_entry ADD journal_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE app_term_journal_entry ADD CONSTRAINT FK_1266CADF478E8802 FOREIGN KEY (journal_id) REFERENCES app_term_journal (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_1266CADF478E8802 ON app_term_journal_entry (journal_id)');
        $this->addSql('ALTER TABLE app_term_translation_journal_entry ADD journal_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE app_term_translation_journal_entry ADD CONSTRAINT FK_53FF201478E8802 FOREIGN KEY (journal_id) REFERENCES app_term_translation_journal (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_53FF201478E8802 ON app_term_translation_journal_entry (journal_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE app_term_journal_entries (journal_id INT NOT NULL, journal_entry_id INT NOT NULL, PRIMARY KEY(journal_id, journal_entry_id))');
        $this->addSql('CREATE UNIQUE INDEX uniq_f168eef36a86e4fb ON app_term_journal_entries (journal_entry_id)');
        $this->addSql('CREATE INDEX idx_f168eef3478e8802 ON app_term_journal_entries (journal_id)');
        $this->addSql('CREATE TABLE app_term_translation_journal_entries (journal_id INT NOT NULL, journal_entry_id INT NOT NULL, PRIMARY KEY(journal_id, journal_entry_id))');
        $this->addSql('CREATE UNIQUE INDEX uniq_c6d1a9a56a86e4fb ON app_term_translation_journal_entries (journal_entry_id)');
        $this->addSql('CREATE INDEX idx_c6d1a9a5478e8802 ON app_term_translation_journal_entries (journal_id)');
        $this->addSql('ALTER TABLE app_term_journal_entries ADD CONSTRAINT fk_f168eef3478e8802 FOREIGN KEY (journal_id) REFERENCES app_term_journal (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE app_term_journal_entries ADD CONSTRAINT fk_f168eef36a86e4fb FOREIGN KEY (journal_entry_id) REFERENCES app_term_journal_entry (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE app_term_translation_journal_entries ADD CONSTRAINT fk_c6d1a9a5478e8802 FOREIGN KEY (journal_id) REFERENCES app_term_translation_journal (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE app_term_translation_journal_entries ADD CONSTRAINT fk_c6d1a9a56a86e4fb FOREIGN KEY (journal_entry_id) REFERENCES app_term_translation_journal_entry (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE app_term_translation_journal_entry DROP CONSTRAINT FK_53FF201478E8802');
        $this->addSql('DROP INDEX IDX_53FF201478E8802');
        $this->addSql('ALTER TABLE app_term_translation_journal_entry DROP journal_id');
        $this->addSql('ALTER TABLE app_term_journal_entry DROP CONSTRAINT FK_1266CADF478E8802');
        $this->addSql('DROP INDEX IDX_1266CADF478E8802');
        $this->addSql('ALTER TABLE app_term_journal_entry DROP journal_id');
    }
}
