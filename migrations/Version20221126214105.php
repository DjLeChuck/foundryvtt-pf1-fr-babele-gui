<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221126214105 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE app_term_item (id INT NOT NULL, unidentified_name VARCHAR(255) DEFAULT NULL, unidentified_description TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE app_term_translation_item (id INT NOT NULL, unidentified_name VARCHAR(255) DEFAULT NULL, unidentified_description TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE app_term_item ADD CONSTRAINT FK_30A30803BF396750 FOREIGN KEY (id) REFERENCES app_term (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE app_term_translation_item ADD CONSTRAINT FK_2DEF2EF8BF396750 FOREIGN KEY (id) REFERENCES app_term_translation (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE app_term_item DROP CONSTRAINT FK_30A30803BF396750');
        $this->addSql('ALTER TABLE app_term_translation_item DROP CONSTRAINT FK_2DEF2EF8BF396750');
        $this->addSql('DROP TABLE app_term_item');
        $this->addSql('DROP TABLE app_term_translation_item');
    }
}
