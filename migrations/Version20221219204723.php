<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221219204723 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE update_tickets (update_id INT NOT NULL, tickets_id INT NOT NULL, INDEX IDX_13F7840DD596EAB1 (update_id), INDEX IDX_13F7840D8FDC0E9A (tickets_id), PRIMARY KEY(update_id, tickets_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE update_tickets ADD CONSTRAINT FK_13F7840DD596EAB1 FOREIGN KEY (update_id) REFERENCES `update` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE update_tickets ADD CONSTRAINT FK_13F7840D8FDC0E9A FOREIGN KEY (tickets_id) REFERENCES tickets (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE `update` DROP FOREIGN KEY FK_98253578700047D2');
        $this->addSql('DROP INDEX IDX_98253578700047D2 ON `update`');
        $this->addSql('ALTER TABLE `update` DROP ticket_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE update_tickets DROP FOREIGN KEY FK_13F7840DD596EAB1');
        $this->addSql('ALTER TABLE update_tickets DROP FOREIGN KEY FK_13F7840D8FDC0E9A');
        $this->addSql('DROP TABLE update_tickets');
        $this->addSql('ALTER TABLE `update` ADD ticket_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE `update` ADD CONSTRAINT FK_98253578700047D2 FOREIGN KEY (ticket_id) REFERENCES tickets (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_98253578700047D2 ON `update` (ticket_id)');
    }
}
