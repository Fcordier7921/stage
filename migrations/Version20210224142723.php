<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210224142723 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE apprenant_entreprise (apprenant_id INT NOT NULL, entreprise_id INT NOT NULL, INDEX IDX_6F938FD5C5697D6D (apprenant_id), INDEX IDX_6F938FD5A4AEAFEA (entreprise_id), PRIMARY KEY(apprenant_id, entreprise_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE apprenant_entreprise ADD CONSTRAINT FK_6F938FD5C5697D6D FOREIGN KEY (apprenant_id) REFERENCES apprenant (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE apprenant_entreprise ADD CONSTRAINT FK_6F938FD5A4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprise (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE candidature CHANGE entreprise_id entreprise_id INT NOT NULL, CHANGE date_relance date_relance DATETIME NOT NULL, CHANGE date_entretient date_entretient DATETIME NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE apprenant_entreprise');
        $this->addSql('ALTER TABLE candidature CHANGE entreprise_id entreprise_id INT DEFAULT NULL, CHANGE date_relance date_relance DATETIME DEFAULT NULL, CHANGE date_entretient date_entretient DATETIME DEFAULT NULL');
    }
}
