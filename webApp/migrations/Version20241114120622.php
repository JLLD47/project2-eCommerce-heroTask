<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241114120622 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD str_xp_rq INT DEFAULT NULL, ADD int_xp_rq INT DEFAULT NULL, ADD const_xp_rq INT DEFAULT NULL, ADD cha_xp_rq INT DEFAULT NULL, ADD str_current INT DEFAULT NULL, ADD int_current INT NOT NULL, ADD const_current INT DEFAULT NULL, ADD cha_current INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP str_xp_rq, DROP int_xp_rq, DROP const_xp_rq, DROP cha_xp_rq, DROP str_current, DROP int_current, DROP const_current, DROP cha_current');
    }
}
