<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241112113100 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE achievements DROP FOREIGN KEY FK_D1227EFE9D86650F');
        $this->addSql('ALTER TABLE user_stats DROP FOREIGN KEY FK_B5859CF29D86650F');
        $this->addSql('ALTER TABLE user_level DROP FOREIGN KEY FK_7828374B9D86650F');
        $this->addSql('ALTER TABLE task_stats DROP FOREIGN KEY FK_90E37C8AB8E08577');
        $this->addSql('ALTER TABLE task DROP FOREIGN KEY FK_527EDB259D86650F');
        $this->addSql('ALTER TABLE profession DROP FOREIGN KEY FK_BA930D699D86650F');
        $this->addSql('DROP TABLE achievements');
        $this->addSql('DROP TABLE user_stats');
        $this->addSql('DROP TABLE user_level');
        $this->addSql('DROP TABLE task_stats');
        $this->addSql('DROP TABLE task');
        $this->addSql('DROP TABLE profession');
        $this->addSql('ALTER TABLE user ADD profession VARCHAR(255) DEFAULT NULL, ADD strength INT DEFAULT NULL, ADD intelligence INT DEFAULT NULL, ADD constitution INT DEFAULT NULL, ADD charisma INT DEFAULT NULL, ADD xp_required INT DEFAULT NULL, CHANGE current_level current_level INT DEFAULT NULL, CHANGE current_xp current_xp INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE achievements (id INT AUTO_INCREMENT NOT NULL, user_id_id INT DEFAULT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, description VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, type VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_D1227EFE9D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE user_stats (id INT AUTO_INCREMENT NOT NULL, user_id_id INT NOT NULL, strength INT NOT NULL, intelligence INT NOT NULL, constitution INT NOT NULL, charisma INT NOT NULL, UNIQUE INDEX UNIQ_B5859CF29D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE user_level (id INT AUTO_INCREMENT NOT NULL, user_id_id INT NOT NULL, UNIQUE INDEX UNIQ_7828374B9D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE task_stats (id INT AUTO_INCREMENT NOT NULL, task_id_id INT DEFAULT NULL, strength_boost INT NOT NULL, intelligence_boost INT NOT NULL, constitution_boost INT NOT NULL, charisma_boost INT NOT NULL, UNIQUE INDEX UNIQ_90E37C8AB8E08577 (task_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE task (id INT AUTO_INCREMENT NOT NULL, user_id_id INT NOT NULL, title VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, description VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, completed TINYINT(1) NOT NULL, difficulty INT NOT NULL, xp_reward INT NOT NULL, recurrence VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, created_at DATE NOT NULL, completed_at DATE NOT NULL, INDEX IDX_527EDB259D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE profession (id INT AUTO_INCREMENT NOT NULL, user_id_id INT NOT NULL, UNIQUE INDEX UNIQ_BA930D699D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE achievements ADD CONSTRAINT FK_D1227EFE9D86650F FOREIGN KEY (user_id_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE user_stats ADD CONSTRAINT FK_B5859CF29D86650F FOREIGN KEY (user_id_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE user_level ADD CONSTRAINT FK_7828374B9D86650F FOREIGN KEY (user_id_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE task_stats ADD CONSTRAINT FK_90E37C8AB8E08577 FOREIGN KEY (task_id_id) REFERENCES task (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT FK_527EDB259D86650F FOREIGN KEY (user_id_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE profession ADD CONSTRAINT FK_BA930D699D86650F FOREIGN KEY (user_id_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE user DROP profession, DROP strength, DROP intelligence, DROP constitution, DROP charisma, DROP xp_required, CHANGE current_level current_level INT NOT NULL, CHANGE current_xp current_xp INT NOT NULL');
    }
}
