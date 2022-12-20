<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221219205949 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `update` ADD ticket_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE `update` ADD CONSTRAINT FK_98253578700047D2 FOREIGN KEY (ticket_id) REFERENCES tickets (id)');
        $this->addSql('CREATE INDEX IDX_98253578700047D2 ON `update` (ticket_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `update` DROP FOREIGN KEY FK_98253578700047D2');
        $this->addSql('DROP INDEX IDX_98253578700047D2 ON `update`');
        $this->addSql('ALTER TABLE `update` DROP ticket_id');
    }
}
