<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220815153839 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE coding_profile (id INT AUTO_INCREMENT NOT NULL, profile_id INT NOT NULL, github VARCHAR(255) DEFAULT NULL, gitlab VARCHAR(255) DEFAULT NULL, bitbucket VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_6F586F21CCFA12B8 (profile_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE coding_profile_system (coding_profile_id INT NOT NULL, system_id INT NOT NULL, INDEX IDX_CB301AF0D81B4726 (coding_profile_id), INDEX IDX_CB301AF0D0952FA5 (system_id), PRIMARY KEY(coding_profile_id, system_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE coding_profile ADD CONSTRAINT FK_6F586F21CCFA12B8 FOREIGN KEY (profile_id) REFERENCES profile (id)');
        $this->addSql('ALTER TABLE coding_profile_system ADD CONSTRAINT FK_CB301AF0D81B4726 FOREIGN KEY (coding_profile_id) REFERENCES coding_profile (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE coding_profile_system ADD CONSTRAINT FK_CB301AF0D0952FA5 FOREIGN KEY (system_id) REFERENCES `system` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE code_language_skill ADD coding_profile_id INT NOT NULL');
        $this->addSql('ALTER TABLE code_language_skill ADD CONSTRAINT FK_6A5C27DCD81B4726 FOREIGN KEY (coding_profile_id) REFERENCES coding_profile (id)');
        $this->addSql('CREATE INDEX IDX_6A5C27DCD81B4726 ON code_language_skill (coding_profile_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE code_language_skill DROP FOREIGN KEY FK_6A5C27DCD81B4726');
        $this->addSql('ALTER TABLE coding_profile DROP FOREIGN KEY FK_6F586F21CCFA12B8');
        $this->addSql('ALTER TABLE coding_profile_system DROP FOREIGN KEY FK_CB301AF0D81B4726');
        $this->addSql('ALTER TABLE coding_profile_system DROP FOREIGN KEY FK_CB301AF0D0952FA5');
        $this->addSql('DROP TABLE coding_profile');
        $this->addSql('DROP TABLE coding_profile_system');
        $this->addSql('DROP INDEX IDX_6A5C27DCD81B4726 ON code_language_skill');
        $this->addSql('ALTER TABLE code_language_skill DROP coding_profile_id');
    }
}
