<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210404234508 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article_caract (id INT AUTO_INCREMENT NOT NULL, article_id INT NOT NULL, taille INT NOT NULL, quantite INT NOT NULL, INDEX IDX_60AC516B7294869C (article_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article_caract ADD CONSTRAINT FK_60AC516B7294869C FOREIGN KEY (article_id) REFERENCES articles_fini (id)');
        $this->addSql('ALTER TABLE articles_fini CHANGE image image VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE commande_gros CHANGE num_colis num_colis VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE commande_unitaire CHANGE num_colis num_colis VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE email email VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE article_caract');
        $this->addSql('ALTER TABLE articles_fini CHANGE image image VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE commande_gros CHANGE num_colis num_colis VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE commande_unitaire CHANGE num_colis num_colis VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE user CHANGE email email VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
    }
}
