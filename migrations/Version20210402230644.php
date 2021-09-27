<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210402230644 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande_gros CHANGE num_colis num_colis VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE commande_unitaire DROP FOREIGN KEY FK_4BDF9948E6B8F115');
        $this->addSql('DROP INDEX IDX_4BDF9948E6B8F115 ON commande_unitaire');
        $this->addSql('ALTER TABLE commande_unitaire DROP articles_fini_id, CHANGE num_colis num_colis VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE email email VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande_gros CHANGE num_colis num_colis VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE commande_unitaire ADD articles_fini_id INT NOT NULL, CHANGE num_colis num_colis VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE commande_unitaire ADD CONSTRAINT FK_4BDF9948E6B8F115 FOREIGN KEY (articles_fini_id) REFERENCES articles_fini (id)');
        $this->addSql('CREATE INDEX IDX_4BDF9948E6B8F115 ON commande_unitaire (articles_fini_id)');
        $this->addSql('ALTER TABLE user CHANGE email email VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
    }
}
