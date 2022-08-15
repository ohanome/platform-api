<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220815142735 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE invitation (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) NOT NULL, code VARCHAR(255) NOT NULL, valid_until DATETIME NOT NULL, used TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE subscription (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, characteristics JSON DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user ADD subscription_id INT DEFAULT NULL, ADD invitation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6499A1887DC FOREIGN KEY (subscription_id) REFERENCES subscription (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649A35D7AF0 FOREIGN KEY (invitation_id) REFERENCES invitation (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D6499A1887DC ON user (subscription_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649A35D7AF0 ON user (invitation_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649A35D7AF0');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6499A1887DC');
        $this->addSql('DROP TABLE invitation');
        $this->addSql('DROP TABLE subscription');
        $this->addSql('DROP INDEX UNIQ_8D93D6499A1887DC ON user');
        $this->addSql('DROP INDEX UNIQ_8D93D649A35D7AF0 ON user');
        $this->addSql('ALTER TABLE user DROP subscription_id, DROP invitation_id');
    }
}
