<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220815150606 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE base_profile (id INT AUTO_INCREMENT NOT NULL, profile_id INT NOT NULL, image_id INT DEFAULT NULL, banner_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, bio LONGTEXT DEFAULT NULL, birthday DATE DEFAULT NULL, gender VARCHAR(255) DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, county VARCHAR(255) DEFAULT NULL, state VARCHAR(255) DEFAULT NULL, country VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_B551136BCCFA12B8 (profile_id), UNIQUE INDEX UNIQ_B551136B3DA5256D (image_id), UNIQUE INDEX UNIQ_B551136B684EC833 (banner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE base_profile ADD CONSTRAINT FK_B551136BCCFA12B8 FOREIGN KEY (profile_id) REFERENCES profile (id)');
        $this->addSql('ALTER TABLE base_profile ADD CONSTRAINT FK_B551136B3DA5256D FOREIGN KEY (image_id) REFERENCES file (id)');
        $this->addSql('ALTER TABLE base_profile ADD CONSTRAINT FK_B551136B684EC833 FOREIGN KEY (banner_id) REFERENCES file (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE base_profile DROP FOREIGN KEY FK_B551136BCCFA12B8');
        $this->addSql('ALTER TABLE base_profile DROP FOREIGN KEY FK_B551136B3DA5256D');
        $this->addSql('ALTER TABLE base_profile DROP FOREIGN KEY FK_B551136B684EC833');
        $this->addSql('DROP TABLE base_profile');
    }
}
