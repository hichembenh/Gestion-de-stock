<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210404235220 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commande_unitaire_article_caract (commande_unitaire_id INT NOT NULL, article_caract_id INT NOT NULL, INDEX IDX_3D51437DAE27E715 (commande_unitaire_id), INDEX IDX_3D51437D5E036247 (article_caract_id), PRIMARY KEY(commande_unitaire_id, article_caract_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commande_unitaire_article_caract ADD CONSTRAINT FK_3D51437DAE27E715 FOREIGN KEY (commande_unitaire_id) REFERENCES commande_unitaire (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commande_unitaire_article_caract ADD CONSTRAINT FK_3D51437D5E036247 FOREIGN KEY (article_caract_id) REFERENCES article_caract (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE articles_fini CHANGE image image VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE commande_gros CHANGE num_colis num_colis VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE commande_unitaire CHANGE num_colis num_colis VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE email email VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE commande_unitaire_article_caract');
        $this->addSql('ALTER TABLE articles_fini CHANGE image image VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE commande_gros CHANGE num_colis num_colis VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE commande_unitaire CHANGE num_colis num_colis VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE user CHANGE email email VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
    }
}
