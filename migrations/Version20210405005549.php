<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210405005549 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article_caract ADD commande_id INT NOT NULL');
        $this->addSql('ALTER TABLE article_caract ADD CONSTRAINT FK_60AC516B82EA2E54 FOREIGN KEY (commande_id) REFERENCES commande_unitaire (id)');
        $this->addSql('CREATE INDEX IDX_60AC516B82EA2E54 ON article_caract (commande_id)');
        $this->addSql('ALTER TABLE articles_fini CHANGE image image VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE commande_gros CHANGE num_colis num_colis VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE commande_unitaire CHANGE num_colis num_colis VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE email email VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article_caract DROP FOREIGN KEY FK_60AC516B82EA2E54');
        $this->addSql('DROP INDEX IDX_60AC516B82EA2E54 ON article_caract');
        $this->addSql('ALTER TABLE article_caract DROP commande_id');
        $this->addSql('ALTER TABLE articles_fini CHANGE image image VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE commande_gros CHANGE num_colis num_colis VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE commande_unitaire CHANGE num_colis num_colis VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE user CHANGE email email VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
    }
}
