<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220803211146 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE app_term ADD translation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE app_term ADD CONSTRAINT FK_A021C22D9CAA2B25 FOREIGN KEY (translation_id) REFERENCES app_term_translation (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A021C22D9CAA2B25 ON app_term (translation_id)');
        $this->addSql('ALTER TABLE app_term_translation DROP CONSTRAINT fk_d1b45234e2c35fc');
        $this->addSql('DROP INDEX uniq_d1b45234e2c35fc');
        $this->addSql('ALTER TABLE app_term_translation DROP term_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE app_term DROP CONSTRAINT FK_A021C22D9CAA2B25');
        $this->addSql('DROP INDEX UNIQ_A021C22D9CAA2B25');
        $this->addSql('ALTER TABLE app_term DROP translation_id');
        $this->addSql('ALTER TABLE app_term_translation ADD term_id INT NOT NULL');
        $this->addSql('ALTER TABLE app_term_translation ADD CONSTRAINT fk_d1b45234e2c35fc FOREIGN KEY (term_id) REFERENCES app_term (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX uniq_d1b45234e2c35fc ON app_term_translation (term_id)');
    }
}
