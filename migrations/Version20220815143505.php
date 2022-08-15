<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220815143505 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE verification_comment (id INT AUTO_INCREMENT NOT NULL, author_id INT NOT NULL, verification_id INT NOT NULL, content LONGTEXT NOT NULL, INDEX IDX_8F1E02BDF675F31B (author_id), INDEX IDX_8F1E02BD1623CB0A (verification_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE verification_comment ADD CONSTRAINT FK_8F1E02BDF675F31B FOREIGN KEY (author_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE verification_comment ADD CONSTRAINT FK_8F1E02BD1623CB0A FOREIGN KEY (verification_id) REFERENCES verification (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE verification_comment DROP FOREIGN KEY FK_8F1E02BDF675F31B');
        $this->addSql('ALTER TABLE verification_comment DROP FOREIGN KEY FK_8F1E02BD1623CB0A');
        $this->addSql('DROP TABLE verification_comment');
    }
}
