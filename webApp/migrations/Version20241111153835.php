<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241111153835 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE profession (id INT AUTO_INCREMENT NOT NULL, user_id_id INT NOT NULL, UNIQUE INDEX UNIQ_BA930D699D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_stats (id INT AUTO_INCREMENT NOT NULL, user_id_id INT NOT NULL, UNIQUE INDEX UNIQ_B5859CF29D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE profession ADD CONSTRAINT FK_BA930D699D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_stats ADD CONSTRAINT FK_B5859CF29D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE profession DROP FOREIGN KEY FK_BA930D699D86650F');
        $this->addSql('ALTER TABLE user_stats DROP FOREIGN KEY FK_B5859CF29D86650F');
        $this->addSql('DROP TABLE profession');
        $this->addSql('DROP TABLE user_stats');
    }
}
