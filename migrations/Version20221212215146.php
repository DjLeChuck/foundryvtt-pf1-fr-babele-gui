<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221212215146 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE app_term_journal (id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE app_term_journal_entries (journal_id INT NOT NULL, journal_entry_id INT NOT NULL, PRIMARY KEY(journal_id, journal_entry_id))');
        $this->addSql('CREATE INDEX IDX_F168EEF3478E8802 ON app_term_journal_entries (journal_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F168EEF36A86E4FB ON app_term_journal_entries (journal_entry_id)');
        $this->addSql('CREATE TABLE app_term_journal_entry (id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE app_term_translation_journal (id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE app_term_translation_journal_entries (journal_id INT NOT NULL, journal_entry_id INT NOT NULL, PRIMARY KEY(journal_id, journal_entry_id))');
        $this->addSql('CREATE INDEX IDX_C6D1A9A5478E8802 ON app_term_translation_journal_entries (journal_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C6D1A9A56A86E4FB ON app_term_translation_journal_entries (journal_entry_id)');
        $this->addSql('CREATE TABLE app_term_translation_journal_entry (id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE app_term_journal ADD CONSTRAINT FK_30C9B610BF396750 FOREIGN KEY (id) REFERENCES app_term (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE app_term_journal_entries ADD CONSTRAINT FK_F168EEF3478E8802 FOREIGN KEY (journal_id) REFERENCES app_term_journal (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE app_term_journal_entries ADD CONSTRAINT FK_F168EEF36A86E4FB FOREIGN KEY (journal_entry_id) REFERENCES app_term_journal_entry (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE app_term_journal_entry ADD CONSTRAINT FK_1266CADFBF396750 FOREIGN KEY (id) REFERENCES app_term (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE app_term_translation_journal ADD CONSTRAINT FK_35ECA4A3BF396750 FOREIGN KEY (id) REFERENCES app_term_translation (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE app_term_translation_journal_entries ADD CONSTRAINT FK_C6D1A9A5478E8802 FOREIGN KEY (journal_id) REFERENCES app_term_translation_journal (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE app_term_translation_journal_entries ADD CONSTRAINT FK_C6D1A9A56A86E4FB FOREIGN KEY (journal_entry_id) REFERENCES app_term_translation_journal_entry (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE app_term_translation_journal_entry ADD CONSTRAINT FK_53FF201BF396750 FOREIGN KEY (id) REFERENCES app_term_translation (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE app_term_journal DROP CONSTRAINT FK_30C9B610BF396750');
        $this->addSql('ALTER TABLE app_term_journal_entries DROP CONSTRAINT FK_F168EEF3478E8802');
        $this->addSql('ALTER TABLE app_term_journal_entries DROP CONSTRAINT FK_F168EEF36A86E4FB');
        $this->addSql('ALTER TABLE app_term_journal_entry DROP CONSTRAINT FK_1266CADFBF396750');
        $this->addSql('ALTER TABLE app_term_translation_journal DROP CONSTRAINT FK_35ECA4A3BF396750');
        $this->addSql('ALTER TABLE app_term_translation_journal_entries DROP CONSTRAINT FK_C6D1A9A5478E8802');
        $this->addSql('ALTER TABLE app_term_translation_journal_entries DROP CONSTRAINT FK_C6D1A9A56A86E4FB');
        $this->addSql('ALTER TABLE app_term_translation_journal_entry DROP CONSTRAINT FK_53FF201BF396750');
        $this->addSql('DROP TABLE app_term_journal');
        $this->addSql('DROP TABLE app_term_journal_entries');
        $this->addSql('DROP TABLE app_term_journal_entry');
        $this->addSql('DROP TABLE app_term_translation_journal');
        $this->addSql('DROP TABLE app_term_translation_journal_entries');
        $this->addSql('DROP TABLE app_term_translation_journal_entry');
    }
}
