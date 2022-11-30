<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221130220944 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE app_term_common_buff (id INT NOT NULL, dictionary_flags JSON DEFAULT NULL, context_notes JSON DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE app_term_translation_common_buff (id INT NOT NULL, dictionary_flags JSON DEFAULT NULL, context_notes JSON DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE app_term_common_buff ADD CONSTRAINT FK_A0624DA9BF396750 FOREIGN KEY (id) REFERENCES app_term (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE app_term_translation_common_buff ADD CONSTRAINT FK_289EFFABBF396750 FOREIGN KEY (id) REFERENCES app_term_translation (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE app_term_common_buff DROP CONSTRAINT FK_A0624DA9BF396750');
        $this->addSql('ALTER TABLE app_term_translation_common_buff DROP CONSTRAINT FK_289EFFABBF396750');
        $this->addSql('DROP TABLE app_term_common_buff');
        $this->addSql('DROP TABLE app_term_translation_common_buff');
    }
}
