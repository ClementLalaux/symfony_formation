<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220525075551 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE candidat (id INT AUTO_INCREMENT NOT NULL, promotion_id_id INT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email_contact VARCHAR(255) DEFAULT NULL, numero_tel VARCHAR(255) DEFAULT NULL, INDEX IDX_6AB5B4711F42EA0A (promotion_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formateur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, numero_tel VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE organisme (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, adresse VARCHAR(255) DEFAULT NULL, numero_tel VARCHAR(10) DEFAULT NULL, email_contact VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE promotion (id INT AUTO_INCREMENT NOT NULL, formation_id_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, INDEX IDX_C11D7DD19CF0022 (formation_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE promotion_formateur (promotion_id INT NOT NULL, formateur_id INT NOT NULL, INDEX IDX_9C01AF62139DF194 (promotion_id), INDEX IDX_9C01AF62155D8F51 (formateur_id), PRIMARY KEY(promotion_id, formateur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE salle (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE salle_session (salle_id INT NOT NULL, session_id INT NOT NULL, INDEX IDX_FD72B985DC304035 (salle_id), INDEX IDX_FD72B985613FECDF (session_id), PRIMARY KEY(salle_id, session_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE session (id INT AUTO_INCREMENT NOT NULL, promotion_id_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, date_debut DATE NOT NULL, date_fin DATE NOT NULL, UNIQUE INDEX UNIQ_D044D5D41F42EA0A (promotion_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE session_formateur (session_id INT NOT NULL, formateur_id INT NOT NULL, INDEX IDX_AE943B45613FECDF (session_id), INDEX IDX_AE943B45155D8F51 (formateur_id), PRIMARY KEY(session_id, formateur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE candidat ADD CONSTRAINT FK_6AB5B4711F42EA0A FOREIGN KEY (promotion_id_id) REFERENCES promotion (id)');
        $this->addSql('ALTER TABLE promotion ADD CONSTRAINT FK_C11D7DD19CF0022 FOREIGN KEY (formation_id_id) REFERENCES formation (id)');
        $this->addSql('ALTER TABLE promotion_formateur ADD CONSTRAINT FK_9C01AF62139DF194 FOREIGN KEY (promotion_id) REFERENCES promotion (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE promotion_formateur ADD CONSTRAINT FK_9C01AF62155D8F51 FOREIGN KEY (formateur_id) REFERENCES formateur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE salle_session ADD CONSTRAINT FK_FD72B985DC304035 FOREIGN KEY (salle_id) REFERENCES salle (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE salle_session ADD CONSTRAINT FK_FD72B985613FECDF FOREIGN KEY (session_id) REFERENCES session (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE session ADD CONSTRAINT FK_D044D5D41F42EA0A FOREIGN KEY (promotion_id_id) REFERENCES promotion (id)');
        $this->addSql('ALTER TABLE session_formateur ADD CONSTRAINT FK_AE943B45613FECDF FOREIGN KEY (session_id) REFERENCES session (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE session_formateur ADD CONSTRAINT FK_AE943B45155D8F51 FOREIGN KEY (formateur_id) REFERENCES formateur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE formation ADD organisme_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE formation ADD CONSTRAINT FK_404021BF3AB366C4 FOREIGN KEY (organisme_id_id) REFERENCES organisme (id)');
        $this->addSql('CREATE INDEX IDX_404021BF3AB366C4 ON formation (organisme_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE promotion_formateur DROP FOREIGN KEY FK_9C01AF62155D8F51');
        $this->addSql('ALTER TABLE session_formateur DROP FOREIGN KEY FK_AE943B45155D8F51');
        $this->addSql('ALTER TABLE formation DROP FOREIGN KEY FK_404021BF3AB366C4');
        $this->addSql('ALTER TABLE candidat DROP FOREIGN KEY FK_6AB5B4711F42EA0A');
        $this->addSql('ALTER TABLE promotion_formateur DROP FOREIGN KEY FK_9C01AF62139DF194');
        $this->addSql('ALTER TABLE session DROP FOREIGN KEY FK_D044D5D41F42EA0A');
        $this->addSql('ALTER TABLE salle_session DROP FOREIGN KEY FK_FD72B985DC304035');
        $this->addSql('ALTER TABLE salle_session DROP FOREIGN KEY FK_FD72B985613FECDF');
        $this->addSql('ALTER TABLE session_formateur DROP FOREIGN KEY FK_AE943B45613FECDF');
        $this->addSql('DROP TABLE candidat');
        $this->addSql('DROP TABLE formateur');
        $this->addSql('DROP TABLE organisme');
        $this->addSql('DROP TABLE promotion');
        $this->addSql('DROP TABLE promotion_formateur');
        $this->addSql('DROP TABLE salle');
        $this->addSql('DROP TABLE salle_session');
        $this->addSql('DROP TABLE session');
        $this->addSql('DROP TABLE session_formateur');
        $this->addSql('DROP INDEX IDX_404021BF3AB366C4 ON formation');
        $this->addSql('ALTER TABLE formation DROP organisme_id_id');
    }
}
