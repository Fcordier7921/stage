<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210301151729 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE annonce_entreprise CHANGE etat_validation etat_validation TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE candidature CHANGE entreprise_id entreprise_id INT NOT NULL, CHANGE date_relance date_relance DATETIME NOT NULL, CHANGE date_entretient date_entretient DATETIME NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE annonce_entreprise CHANGE etat_validation etat_validation TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE candidature CHANGE entreprise_id entreprise_id INT DEFAULT NULL, CHANGE date_relance date_relance DATETIME DEFAULT NULL, CHANGE date_entretient date_entretient DATETIME DEFAULT NULL');
    }
}
