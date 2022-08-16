<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220816173212 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE base_profile ADD created DATETIME NOT NULL, ADD updated DATETIME NOT NULL');
        $this->addSql('ALTER TABLE bit_transaction ADD created DATETIME NOT NULL, ADD updated DATETIME NOT NULL');
        $this->addSql('ALTER TABLE bookmark ADD created DATETIME NOT NULL, ADD updated DATETIME NOT NULL');
        $this->addSql('ALTER TABLE code_language ADD created DATETIME NOT NULL, ADD updated DATETIME NOT NULL');
        $this->addSql('ALTER TABLE code_language_skill ADD created DATETIME NOT NULL, ADD updated DATETIME NOT NULL');
        $this->addSql('ALTER TABLE coding_profile ADD created DATETIME NOT NULL, ADD updated DATETIME NOT NULL');
        $this->addSql('ALTER TABLE education_degree ADD created DATETIME NOT NULL, ADD updated DATETIME NOT NULL');
        $this->addSql('ALTER TABLE file ADD created DATETIME NOT NULL, ADD updated DATETIME NOT NULL');
        $this->addSql('ALTER TABLE game ADD created DATETIME NOT NULL, ADD updated DATETIME NOT NULL');
        $this->addSql('ALTER TABLE gaming_platform ADD created DATETIME NOT NULL, ADD updated DATETIME NOT NULL');
        $this->addSql('ALTER TABLE gaming_profile ADD created DATETIME NOT NULL, ADD updated DATETIME NOT NULL');
        $this->addSql('ALTER TABLE invitation ADD created DATETIME NOT NULL, ADD updated DATETIME NOT NULL');
        $this->addSql('ALTER TABLE job_profile ADD created DATETIME NOT NULL, ADD updated DATETIME NOT NULL');
        $this->addSql('ALTER TABLE `like` ADD created DATETIME NOT NULL, ADD updated DATETIME NOT NULL');
        $this->addSql('ALTER TABLE post ADD created DATETIME NOT NULL, ADD updated DATETIME NOT NULL');
        $this->addSql('ALTER TABLE profile ADD created DATETIME NOT NULL, ADD updated DATETIME NOT NULL');
        $this->addSql('ALTER TABLE reaction ADD created DATETIME NOT NULL, ADD updated DATETIME NOT NULL');
        $this->addSql('ALTER TABLE relationship_profile ADD created DATETIME NOT NULL, ADD updated DATETIME NOT NULL');
        $this->addSql('ALTER TABLE skill ADD created DATETIME NOT NULL, ADD updated DATETIME NOT NULL');
        $this->addSql('ALTER TABLE social_media_profile ADD created DATETIME NOT NULL, ADD updated DATETIME NOT NULL');
        $this->addSql('ALTER TABLE subscription ADD created DATETIME NOT NULL, ADD updated DATETIME NOT NULL');
        $this->addSql('ALTER TABLE `system` ADD created DATETIME NOT NULL, ADD updated DATETIME NOT NULL');
        $this->addSql('ALTER TABLE system_type ADD created DATETIME NOT NULL, ADD updated DATETIME NOT NULL');
        $this->addSql('ALTER TABLE user ADD created DATETIME NOT NULL, ADD updated DATETIME NOT NULL');
        $this->addSql('ALTER TABLE user_settings ADD created DATETIME NOT NULL, ADD updated DATETIME NOT NULL');
        $this->addSql('ALTER TABLE verification ADD created DATETIME NOT NULL, ADD updated DATETIME NOT NULL');
        $this->addSql('ALTER TABLE verification_comment ADD created DATETIME NOT NULL, ADD updated DATETIME NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE base_profile DROP created, DROP updated');
        $this->addSql('ALTER TABLE bit_transaction DROP created, DROP updated');
        $this->addSql('ALTER TABLE bookmark DROP created, DROP updated');
        $this->addSql('ALTER TABLE code_language DROP created, DROP updated');
        $this->addSql('ALTER TABLE code_language_skill DROP created, DROP updated');
        $this->addSql('ALTER TABLE coding_profile DROP created, DROP updated');
        $this->addSql('ALTER TABLE education_degree DROP created, DROP updated');
        $this->addSql('ALTER TABLE file DROP created, DROP updated');
        $this->addSql('ALTER TABLE game DROP created, DROP updated');
        $this->addSql('ALTER TABLE gaming_platform DROP created, DROP updated');
        $this->addSql('ALTER TABLE gaming_profile DROP created, DROP updated');
        $this->addSql('ALTER TABLE invitation DROP created, DROP updated');
        $this->addSql('ALTER TABLE job_profile DROP created, DROP updated');
        $this->addSql('ALTER TABLE `like` DROP created, DROP updated');
        $this->addSql('ALTER TABLE post DROP created, DROP updated');
        $this->addSql('ALTER TABLE profile DROP created, DROP updated');
        $this->addSql('ALTER TABLE reaction DROP created, DROP updated');
        $this->addSql('ALTER TABLE relationship_profile DROP created, DROP updated');
        $this->addSql('ALTER TABLE skill DROP created, DROP updated');
        $this->addSql('ALTER TABLE social_media_profile DROP created, DROP updated');
        $this->addSql('ALTER TABLE subscription DROP created, DROP updated');
        $this->addSql('ALTER TABLE `system` DROP created, DROP updated');
        $this->addSql('ALTER TABLE system_type DROP created, DROP updated');
        $this->addSql('ALTER TABLE user DROP created, DROP updated');
        $this->addSql('ALTER TABLE user_settings DROP created, DROP updated');
        $this->addSql('ALTER TABLE verification DROP created, DROP updated');
        $this->addSql('ALTER TABLE verification_comment DROP created, DROP updated');
    }
}
