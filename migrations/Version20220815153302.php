<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220815153302 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE code_language_skill (id INT AUTO_INCREMENT NOT NULL, code_language_id INT NOT NULL, level VARCHAR(255) NOT NULL, years INT NOT NULL, projects INT NOT NULL, INDEX IDX_6A5C27DCCBB05344 (code_language_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE code_language_skill ADD CONSTRAINT FK_6A5C27DCCBB05344 FOREIGN KEY (code_language_id) REFERENCES code_language (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE code_language_skill DROP FOREIGN KEY FK_6A5C27DCCBB05344');
        $this->addSql('DROP TABLE code_language_skill');
    }
}
