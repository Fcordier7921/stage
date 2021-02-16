<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210216082749 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE apprenant_annonce_entreprise (apprenant_id INT NOT NULL, annonce_entreprise_id INT NOT NULL, INDEX IDX_6FF21B3FC5697D6D (apprenant_id), INDEX IDX_6FF21B3FECFA8E52 (annonce_entreprise_id), PRIMARY KEY(apprenant_id, annonce_entreprise_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE apprenant_annonce_entreprise ADD CONSTRAINT FK_6FF21B3FC5697D6D FOREIGN KEY (apprenant_id) REFERENCES apprenant (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE apprenant_annonce_entreprise ADD CONSTRAINT FK_6FF21B3FECFA8E52 FOREIGN KEY (annonce_entreprise_id) REFERENCES annonce_entreprise (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE apprenant CHANGE mobilit mobilité TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE candidature ADD apprenant_id INT NOT NULL');
        $this->addSql('ALTER TABLE candidature ADD CONSTRAINT FK_E33BD3B8C5697D6D FOREIGN KEY (apprenant_id) REFERENCES apprenant (id)');
        $this->addSql('CREATE INDEX IDX_E33BD3B8C5697D6D ON candidature (apprenant_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE apprenant_annonce_entreprise');
        $this->addSql('ALTER TABLE apprenant CHANGE mobilité mobilit TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE candidature DROP FOREIGN KEY FK_E33BD3B8C5697D6D');
        $this->addSql('DROP INDEX IDX_E33BD3B8C5697D6D ON candidature');
        $this->addSql('ALTER TABLE candidature DROP apprenant_id');
    }
}
