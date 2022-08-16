<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220816181228 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE audit (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, profile_id INT DEFAULT NULL, message LONGTEXT NOT NULL, created DATETIME NOT NULL, updated DATETIME NOT NULL, INDEX IDX_9218FF79A76ED395 (user_id), INDEX IDX_9218FF79CCFA12B8 (profile_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE audit ADD CONSTRAINT FK_9218FF79A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE audit ADD CONSTRAINT FK_9218FF79CCFA12B8 FOREIGN KEY (profile_id) REFERENCES profile (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE audit DROP FOREIGN KEY FK_9218FF79A76ED395');
        $this->addSql('ALTER TABLE audit DROP FOREIGN KEY FK_9218FF79CCFA12B8');
        $this->addSql('DROP TABLE audit');
    }
}
