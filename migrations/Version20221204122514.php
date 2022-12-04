<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221204122514 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE app_term_bestiary (id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE app_term_translation_bestiary (id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE app_term_bestiary ADD CONSTRAINT FK_8146AAE7BF396750 FOREIGN KEY (id) REFERENCES app_term (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE app_term_translation_bestiary ADD CONSTRAINT FK_D32B6DC3BF396750 FOREIGN KEY (id) REFERENCES app_term_translation (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE app_term_bestiary DROP CONSTRAINT FK_8146AAE7BF396750');
        $this->addSql('ALTER TABLE app_term_translation_bestiary DROP CONSTRAINT FK_D32B6DC3BF396750');
        $this->addSql('DROP TABLE app_term_bestiary');
        $this->addSql('DROP TABLE app_term_translation_bestiary');
    }
}
