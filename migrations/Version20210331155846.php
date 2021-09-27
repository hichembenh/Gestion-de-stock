<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210331155846 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE articles_fini (id INT AUTO_INCREMENT NOT NULL, ref VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, quantite INT NOT NULL, date_creation DATETIME NOT NULL, etat TINYINT(1) DEFAULT \'0\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE calendrier (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, start DATETIME NOT NULL, end DATETIME NOT NULL, description LONGTEXT NOT NULL, all_day TINYINT(1) NOT NULL, background_color VARCHAR(7) NOT NULL, border_color VARCHAR(7) NOT NULL, text_color VARCHAR(7) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande_gros (id INT AUTO_INCREMENT NOT NULL, ref VARCHAR(255) NOT NULL, montant_total INT NOT NULL, mondat INT NOT NULL, reste_payer INT NOT NULL, nom_prop VARCHAR(255) NOT NULL, num_tel INT NOT NULL, etat VARCHAR(255) NOT NULL, date_creation DATETIME NOT NULL, adresse VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande_unitaire (id INT AUTO_INCREMENT NOT NULL, ref VARCHAR(255) NOT NULL, prix INT NOT NULL, adresse VARCHAR(255) NOT NULL, num_tel INT NOT NULL, nom_client VARCHAR(255) NOT NULL, date_creation DATETIME NOT NULL, num_colis VARCHAR(255) DEFAULT NULL, etat INT DEFAULT 0 NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, nom_utilisateur VARCHAR(255) NOT NULL, mot_de_passe VARCHAR(255) NOT NULL, email VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE articles_fini');
        $this->addSql('DROP TABLE calendrier');
        $this->addSql('DROP TABLE commande_gros');
        $this->addSql('DROP TABLE commande_unitaire');
        $this->addSql('DROP TABLE user');
    }
}
