<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221126150435 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE app_term_class (id INT NOT NULL, custom_weapon_prof VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE app_term_translation_class (id INT NOT NULL, custom_weapon_prof VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE app_term_class ADD CONSTRAINT FK_8E62CD6BBF396750 FOREIGN KEY (id) REFERENCES app_term (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE app_term_translation_class ADD CONSTRAINT FK_A410AAD9BF396750 FOREIGN KEY (id) REFERENCES app_term_translation (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE app_term ADD discr VARCHAR(255) NOT NULL DEFAULT \'unknown\'');
        $this->addSql('ALTER TABLE app_term_translation ADD discr VARCHAR(255) NOT NULL DEFAULT \'unknown\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE app_term_class DROP CONSTRAINT FK_8E62CD6BBF396750');
        $this->addSql('ALTER TABLE app_term_translation_class DROP CONSTRAINT FK_A410AAD9BF396750');
        $this->addSql('DROP TABLE app_term_class');
        $this->addSql('DROP TABLE app_term_translation_class');
        $this->addSql('ALTER TABLE app_term DROP discr');
        $this->addSql('ALTER TABLE app_term_translation DROP discr');
    }
}
