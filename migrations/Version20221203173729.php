<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221203173729 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE app_term_armor_and_shield (id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE app_term_class_ability (id INT NOT NULL, actions JSON DEFAULT NULL, context_notes JSON DEFAULT NULL, tags JSON DEFAULT NULL, classes JSON DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE app_term_translation_armor_and_shield (id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE app_term_translation_class_ability (id INT NOT NULL, actions JSON DEFAULT NULL, context_notes JSON DEFAULT NULL, tags JSON DEFAULT NULL, classes JSON DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE app_term_armor_and_shield ADD CONSTRAINT FK_7FE423BFBF396750 FOREIGN KEY (id) REFERENCES app_term (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE app_term_class_ability ADD CONSTRAINT FK_2A26ED45BF396750 FOREIGN KEY (id) REFERENCES app_term (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE app_term_translation_armor_and_shield ADD CONSTRAINT FK_FDDB6E39BF396750 FOREIGN KEY (id) REFERENCES app_term_translation (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE app_term_translation_class_ability ADD CONSTRAINT FK_3D7FD59BBF396750 FOREIGN KEY (id) REFERENCES app_term_translation (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE app_term_armor_and_shield DROP CONSTRAINT FK_7FE423BFBF396750');
        $this->addSql('ALTER TABLE app_term_class_ability DROP CONSTRAINT FK_2A26ED45BF396750');
        $this->addSql('ALTER TABLE app_term_translation_armor_and_shield DROP CONSTRAINT FK_FDDB6E39BF396750');
        $this->addSql('ALTER TABLE app_term_translation_class_ability DROP CONSTRAINT FK_3D7FD59BBF396750');
        $this->addSql('DROP TABLE app_term_armor_and_shield');
        $this->addSql('DROP TABLE app_term_class_ability');
        $this->addSql('DROP TABLE app_term_translation_armor_and_shield');
        $this->addSql('DROP TABLE app_term_translation_class_ability');
    }
}
