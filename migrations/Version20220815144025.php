<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220815144025 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE bit_transaction (id INT AUTO_INCREMENT NOT NULL, sender_id INT NOT NULL, receiver_id INT NOT NULL, amount INT NOT NULL, INDEX IDX_32F2E0AEF624B39D (sender_id), INDEX IDX_32F2E0AECD53EDB6 (receiver_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE bit_transaction ADD CONSTRAINT FK_32F2E0AEF624B39D FOREIGN KEY (sender_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE bit_transaction ADD CONSTRAINT FK_32F2E0AECD53EDB6 FOREIGN KEY (receiver_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bit_transaction DROP FOREIGN KEY FK_32F2E0AEF624B39D');
        $this->addSql('ALTER TABLE bit_transaction DROP FOREIGN KEY FK_32F2E0AECD53EDB6');
        $this->addSql('DROP TABLE bit_transaction');
    }
}
