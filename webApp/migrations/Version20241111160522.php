<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241111160522 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE achievements (id INT AUTO_INCREMENT NOT NULL, user_id_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, type VARCHAR(255) NOT NULL, INDEX IDX_D1227EFE9D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE task_stats (id INT AUTO_INCREMENT NOT NULL, task_id_id INT DEFAULT NULL, strength_boost INT NOT NULL, intelligence_boost INT NOT NULL, constitution_boost INT NOT NULL, charisma_boost INT NOT NULL, UNIQUE INDEX UNIQ_90E37C8AB8E08577 (task_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE achievements ADD CONSTRAINT FK_D1227EFE9D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE task_stats ADD CONSTRAINT FK_90E37C8AB8E08577 FOREIGN KEY (task_id_id) REFERENCES task (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE achievements DROP FOREIGN KEY FK_D1227EFE9D86650F');
        $this->addSql('ALTER TABLE task_stats DROP FOREIGN KEY FK_90E37C8AB8E08577');
        $this->addSql('DROP TABLE achievements');
        $this->addSql('DROP TABLE task_stats');
    }
}
