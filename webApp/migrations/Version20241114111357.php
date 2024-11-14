<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241114111357 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE task_stats (id INT AUTO_INCREMENT NOT NULL, task_id INT DEFAULT NULL, strength_xp INT DEFAULT NULL, intelligence_xp INT NOT NULL, constitution_xp INT DEFAULT NULL, charisma_xp INT DEFAULT NULL, UNIQUE INDEX UNIQ_90E37C8A8DB60186 (task_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE task_stats ADD CONSTRAINT FK_90E37C8A8DB60186 FOREIGN KEY (task_id) REFERENCES task (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE task_stats DROP FOREIGN KEY FK_90E37C8A8DB60186');
        $this->addSql('DROP TABLE task_stats');
    }
}
