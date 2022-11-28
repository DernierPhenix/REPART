<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221128115743 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE tickets (id INT AUTO_INCREMENT NOT NULL, produits_id INT DEFAULT NULL, clients_id INT DEFAULT NULL, user_id INT DEFAULT NULL, etat LONGTEXT NOT NULL, statut VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, rapport LONGTEXT NOT NULL, modele VARCHAR(255) NOT NULL, INDEX IDX_54469DF4CD11A2CF (produits_id), INDEX IDX_54469DF4AB014612 (clients_id), INDEX IDX_54469DF4A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tickets ADD CONSTRAINT FK_54469DF4CD11A2CF FOREIGN KEY (produits_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE tickets ADD CONSTRAINT FK_54469DF4AB014612 FOREIGN KEY (clients_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE tickets ADD CONSTRAINT FK_54469DF4A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE categories DROP prenom');
        $this->addSql('ALTER TABLE produit ADD sous_categories_id INT DEFAULT NULL, DROP modele');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC279F751138 FOREIGN KEY (sous_categories_id) REFERENCES sous_categorie (id)');
        $this->addSql('CREATE INDEX IDX_29A5EC279F751138 ON produit (sous_categories_id)');
        $this->addSql('ALTER TABLE sous_categorie ADD categories_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE sous_categorie ADD CONSTRAINT FK_52743D7BA21214B7 FOREIGN KEY (categories_id) REFERENCES categories (id)');
        $this->addSql('CREATE INDEX IDX_52743D7BA21214B7 ON sous_categorie (categories_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tickets DROP FOREIGN KEY FK_54469DF4CD11A2CF');
        $this->addSql('ALTER TABLE tickets DROP FOREIGN KEY FK_54469DF4AB014612');
        $this->addSql('ALTER TABLE tickets DROP FOREIGN KEY FK_54469DF4A76ED395');
        $this->addSql('DROP TABLE tickets');
        $this->addSql('ALTER TABLE categories ADD prenom VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC279F751138');
        $this->addSql('DROP INDEX IDX_29A5EC279F751138 ON produit');
        $this->addSql('ALTER TABLE produit ADD modele VARCHAR(255) NOT NULL, DROP sous_categories_id');
        $this->addSql('ALTER TABLE sous_categorie DROP FOREIGN KEY FK_52743D7BA21214B7');
        $this->addSql('DROP INDEX IDX_52743D7BA21214B7 ON sous_categorie');
        $this->addSql('ALTER TABLE sous_categorie DROP categories_id');
    }
}
