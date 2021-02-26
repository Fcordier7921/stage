<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210226121934 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE candidature CHANGE entreprise_id entreprise_id INT NULL, CHANGE date_relance date_relance DATETIME NULL, CHANGE date_entretient date_entretient DATETIME NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE candidature CHANGE entreprise_id entreprise_id INT DEFAULT NULL, CHANGE date_relance date_relance DATETIME DEFAULT NULL, CHANGE date_entretient date_entretient DATETIME DEFAULT NULL');
    }
}
