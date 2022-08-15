<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220815153007 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE gaming_profile (id INT AUTO_INCREMENT NOT NULL, profile_id INT NOT NULL, minecraft VARCHAR(255) DEFAULT NULL, valorant VARCHAR(255) DEFAULT NULL, league_of_legends VARCHAR(255) DEFAULT NULL, battle_net VARCHAR(255) DEFAULT NULL, ubisoft_connect VARCHAR(255) DEFAULT NULL, valve_steam VARCHAR(255) DEFAULT NULL, ea_origin VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_11BBD61BCCFA12B8 (profile_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gaming_profile_game (gaming_profile_id INT NOT NULL, game_id INT NOT NULL, INDEX IDX_F0D333A0FDE3812D (gaming_profile_id), INDEX IDX_F0D333A0E48FD905 (game_id), PRIMARY KEY(gaming_profile_id, game_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gaming_profile_gaming_platform (gaming_profile_id INT NOT NULL, gaming_platform_id INT NOT NULL, INDEX IDX_ED7359AFDE3812D (gaming_profile_id), INDEX IDX_ED7359A7FB23737 (gaming_platform_id), PRIMARY KEY(gaming_profile_id, gaming_platform_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE gaming_profile ADD CONSTRAINT FK_11BBD61BCCFA12B8 FOREIGN KEY (profile_id) REFERENCES profile (id)');
        $this->addSql('ALTER TABLE gaming_profile_game ADD CONSTRAINT FK_F0D333A0FDE3812D FOREIGN KEY (gaming_profile_id) REFERENCES gaming_profile (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE gaming_profile_game ADD CONSTRAINT FK_F0D333A0E48FD905 FOREIGN KEY (game_id) REFERENCES game (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE gaming_profile_gaming_platform ADD CONSTRAINT FK_ED7359AFDE3812D FOREIGN KEY (gaming_profile_id) REFERENCES gaming_profile (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE gaming_profile_gaming_platform ADD CONSTRAINT FK_ED7359A7FB23737 FOREIGN KEY (gaming_platform_id) REFERENCES gaming_platform (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gaming_profile DROP FOREIGN KEY FK_11BBD61BCCFA12B8');
        $this->addSql('ALTER TABLE gaming_profile_game DROP FOREIGN KEY FK_F0D333A0FDE3812D');
        $this->addSql('ALTER TABLE gaming_profile_game DROP FOREIGN KEY FK_F0D333A0E48FD905');
        $this->addSql('ALTER TABLE gaming_profile_gaming_platform DROP FOREIGN KEY FK_ED7359AFDE3812D');
        $this->addSql('ALTER TABLE gaming_profile_gaming_platform DROP FOREIGN KEY FK_ED7359A7FB23737');
        $this->addSql('DROP TABLE gaming_profile');
        $this->addSql('DROP TABLE gaming_profile_game');
        $this->addSql('DROP TABLE gaming_profile_gaming_platform');
    }
}
