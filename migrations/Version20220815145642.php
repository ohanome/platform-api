<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220815145642 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE verification ADD video_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE verification ADD CONSTRAINT FK_5AF1C50B29C1004E FOREIGN KEY (video_id) REFERENCES file (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5AF1C50B29C1004E ON verification (video_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE verification DROP FOREIGN KEY FK_5AF1C50B29C1004E');
        $this->addSql('DROP INDEX UNIQ_5AF1C50B29C1004E ON verification');
        $this->addSql('ALTER TABLE verification DROP video_id');
    }
}
