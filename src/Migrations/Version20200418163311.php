<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200418163311 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE achat (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT DEFAULT NULL, pack_jeton_id INT DEFAULT NULL, date_achat DATE NOT NULL, INDEX IDX_26A98456FB88E14F (utilisateur_id), INDEX IDX_26A984561A207710 (pack_jeton_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE enchere (id INT AUTO_INCREMENT NOT NULL, produit_id INT NOT NULL, numero INT NOT NULL, date_debut DATE NOT NULL, date_fin DATE NOT NULL, INDEX IDX_38D1870FF347EFB (produit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE historique_enchere (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT DEFAULT NULL, enchere_id INT DEFAULT NULL, date_enchere DATE NOT NULL, prix DOUBLE PRECISION NOT NULL, INDEX IDX_5AC5D870FB88E14F (utilisateur_id), INDEX IDX_5AC5D870E80B6EFB (enchere_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pack_jeton (id INT AUTO_INCREMENT NOT NULL, nb_jetons INT NOT NULL, descrption VARCHAR(50) NOT NULL, prix DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit (id INT AUTO_INCREMENT NOT NULL, reference VARCHAR(50) NOT NULL, descriptif VARCHAR(100) NOT NULL, prix DOUBLE PRECISION NOT NULL, image VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role (id INT AUTO_INCREMENT NOT NULL, niveau INT NOT NULL, description VARCHAR(25) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE achat ADD CONSTRAINT FK_26A98456FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE achat ADD CONSTRAINT FK_26A984561A207710 FOREIGN KEY (pack_jeton_id) REFERENCES pack_jeton (id)');
        $this->addSql('ALTER TABLE enchere ADD CONSTRAINT FK_38D1870FF347EFB FOREIGN KEY (produit_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE historique_enchere ADD CONSTRAINT FK_5AC5D870FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE historique_enchere ADD CONSTRAINT FK_5AC5D870E80B6EFB FOREIGN KEY (enchere_id) REFERENCES enchere (id)');
        $this->addSql('ALTER TABLE utilisateur ADD role_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B3D60322AC FOREIGN KEY (role_id) REFERENCES role (id)');
        $this->addSql('CREATE INDEX IDX_1D1C63B3D60322AC ON utilisateur (role_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE historique_enchere DROP FOREIGN KEY FK_5AC5D870E80B6EFB');
        $this->addSql('ALTER TABLE achat DROP FOREIGN KEY FK_26A984561A207710');
        $this->addSql('ALTER TABLE enchere DROP FOREIGN KEY FK_38D1870FF347EFB');
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B3D60322AC');
        $this->addSql('DROP TABLE achat');
        $this->addSql('DROP TABLE enchere');
        $this->addSql('DROP TABLE historique_enchere');
        $this->addSql('DROP TABLE pack_jeton');
        $this->addSql('DROP TABLE produit');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP INDEX IDX_1D1C63B3D60322AC ON utilisateur');
        $this->addSql('ALTER TABLE utilisateur DROP role_id');
    }
}
