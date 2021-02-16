<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210216083514 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE annonce_entreprise ADD entreprise_id INT NOT NULL');
        $this->addSql('ALTER TABLE annonce_entreprise ADD CONSTRAINT FK_136D2FE3A4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprise (id)');
        $this->addSql('CREATE INDEX IDX_136D2FE3A4AEAFEA ON annonce_entreprise (entreprise_id)');
        $this->addSql('ALTER TABLE apprenant CHANGE mobilit mobilité TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE candidature ADD entreprise_id INT NOT NULL');
        $this->addSql('ALTER TABLE candidature ADD CONSTRAINT FK_E33BD3B8A4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprise (id)');
        $this->addSql('CREATE INDEX IDX_E33BD3B8A4AEAFEA ON candidature (entreprise_id)');
        $this->addSql('ALTER TABLE contact ADD entreprise_id INT NOT NULL');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E638A4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprise (id)');
        $this->addSql('CREATE INDEX IDX_4C62E638A4AEAFEA ON contact (entreprise_id)');
        $this->addSql('ALTER TABLE entreprise ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE entreprise ADD CONSTRAINT FK_D19FA60A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D19FA60A76ED395 ON entreprise (user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE annonce_entreprise DROP FOREIGN KEY FK_136D2FE3A4AEAFEA');
        $this->addSql('DROP INDEX IDX_136D2FE3A4AEAFEA ON annonce_entreprise');
        $this->addSql('ALTER TABLE annonce_entreprise DROP entreprise_id');
        $this->addSql('ALTER TABLE apprenant CHANGE mobilité mobilit TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE candidature DROP FOREIGN KEY FK_E33BD3B8A4AEAFEA');
        $this->addSql('DROP INDEX IDX_E33BD3B8A4AEAFEA ON candidature');
        $this->addSql('ALTER TABLE candidature DROP entreprise_id');
        $this->addSql('ALTER TABLE contact DROP FOREIGN KEY FK_4C62E638A4AEAFEA');
        $this->addSql('DROP INDEX IDX_4C62E638A4AEAFEA ON contact');
        $this->addSql('ALTER TABLE contact DROP entreprise_id');
        $this->addSql('ALTER TABLE entreprise DROP FOREIGN KEY FK_D19FA60A76ED395');
        $this->addSql('DROP INDEX UNIQ_D19FA60A76ED395 ON entreprise');
        $this->addSql('ALTER TABLE entreprise DROP user_id');
    }
}
