<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210216075908 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE apprenant (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, adress VARCHAR(255) NOT NULL, code_postal BIGINT NOT NULL, ville VARCHAR(255) NOT NULL, telephone BIGINT NOT NULL, email VARCHAR(255) NOT NULL, portfolio VARCHAR(255) NOT NULL, git VARCHAR(255) NOT NULL, cv VARCHAR(255) NOT NULL, promo_anne DATE NOT NULL, promo_ville VARCHAR(255) NOT NULL, avatar VARCHAR(255) NOT NULL, competences VARCHAR(255) NOT NULL, mobilité TINYINT(1) NOT NULL, zone_geographique VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE apprenant');
    }
}
