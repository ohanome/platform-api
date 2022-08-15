<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220815151629 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE job_profile (id INT AUTO_INCREMENT NOT NULL, profile_id INT NOT NULL, education_id INT DEFAULT NULL, employment_status VARCHAR(255) DEFAULT NULL, employer VARCHAR(255) DEFAULT NULL, industry VARCHAR(255) DEFAULT NULL, position VARCHAR(255) DEFAULT NULL, salary_expectation INT DEFAULT NULL, UNIQUE INDEX UNIQ_1BB81D94CCFA12B8 (profile_id), UNIQUE INDEX UNIQ_1BB81D942CA1BD71 (education_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE job_profile ADD CONSTRAINT FK_1BB81D94CCFA12B8 FOREIGN KEY (profile_id) REFERENCES profile (id)');
        $this->addSql('ALTER TABLE job_profile ADD CONSTRAINT FK_1BB81D942CA1BD71 FOREIGN KEY (education_id) REFERENCES education_degree (id)');
        $this->addSql('ALTER TABLE skill ADD job_profile_id INT NOT NULL');
        $this->addSql('ALTER TABLE skill ADD CONSTRAINT FK_5E3DE477A68D82A5 FOREIGN KEY (job_profile_id) REFERENCES job_profile (id)');
        $this->addSql('CREATE INDEX IDX_5E3DE477A68D82A5 ON skill (job_profile_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE skill DROP FOREIGN KEY FK_5E3DE477A68D82A5');
        $this->addSql('ALTER TABLE job_profile DROP FOREIGN KEY FK_1BB81D94CCFA12B8');
        $this->addSql('ALTER TABLE job_profile DROP FOREIGN KEY FK_1BB81D942CA1BD71');
        $this->addSql('DROP TABLE job_profile');
        $this->addSql('DROP INDEX IDX_5E3DE477A68D82A5 ON skill');
        $this->addSql('ALTER TABLE skill DROP job_profile_id');
    }
}
