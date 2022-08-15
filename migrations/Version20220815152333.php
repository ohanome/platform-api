<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220815152333 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE social_media_profile (id INT AUTO_INCREMENT NOT NULL, profile_id INT NOT NULL, twitter VARCHAR(255) DEFAULT NULL, twitch VARCHAR(255) DEFAULT NULL, instagram VARCHAR(255) DEFAULT NULL, facebook VARCHAR(255) DEFAULT NULL, tiktok VARCHAR(255) DEFAULT NULL, bereal VARCHAR(255) DEFAULT NULL, linkedin VARCHAR(255) DEFAULT NULL, xing VARCHAR(255) DEFAULT NULL, pinterest VARCHAR(255) DEFAULT NULL, discord VARCHAR(255) DEFAULT NULL, telegram VARCHAR(255) DEFAULT NULL, behance VARCHAR(255) DEFAULT NULL, dribbble VARCHAR(255) DEFAULT NULL, turbosquid VARCHAR(255) DEFAULT NULL, spotify VARCHAR(255) DEFAULT NULL, soundcloud VARCHAR(255) DEFAULT NULL, website VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_563AA2D2CCFA12B8 (profile_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE social_media_profile ADD CONSTRAINT FK_563AA2D2CCFA12B8 FOREIGN KEY (profile_id) REFERENCES profile (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE social_media_profile DROP FOREIGN KEY FK_563AA2D2CCFA12B8');
        $this->addSql('DROP TABLE social_media_profile');
    }
}
