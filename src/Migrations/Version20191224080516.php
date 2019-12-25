<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191224080516 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE detail_size (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(15) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE measure (id INT AUTO_INCREMENT NOT NULL, candidate_id INT NOT NULL, waiting_pants_id INT DEFAULT NULL, fire_pants_id INT DEFAULT NULL, sweat_id INT DEFAULT NULL, teeshirt_id INT DEFAULT NULL, fire_jacket_id INT DEFAULT NULL, rubber_boots SMALLINT DEFAULT NULL, ranger_boots SMALLINT DEFAULT NULL, fire_gloves SMALLINT DEFAULT NULL, UNIQUE INDEX UNIQ_8007192591BD8781 (candidate_id), INDEX IDX_800719251B196FF4 (waiting_pants_id), INDEX IDX_800719257745528D (fire_pants_id), INDEX IDX_80071925EF044C42 (sweat_id), INDEX IDX_800719254F74C967 (teeshirt_id), INDEX IDX_80071925ACC14410 (fire_jacket_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE measure ADD CONSTRAINT FK_8007192591BD8781 FOREIGN KEY (candidate_id) REFERENCES candidate (id)');
        $this->addSql('ALTER TABLE measure ADD CONSTRAINT FK_800719251B196FF4 FOREIGN KEY (waiting_pants_id) REFERENCES detail_size (id)');
        $this->addSql('ALTER TABLE measure ADD CONSTRAINT FK_800719257745528D FOREIGN KEY (fire_pants_id) REFERENCES detail_size (id)');
        $this->addSql('ALTER TABLE measure ADD CONSTRAINT FK_80071925EF044C42 FOREIGN KEY (sweat_id) REFERENCES detail_size (id)');
        $this->addSql('ALTER TABLE measure ADD CONSTRAINT FK_800719254F74C967 FOREIGN KEY (teeshirt_id) REFERENCES detail_size (id)');
        $this->addSql('ALTER TABLE measure ADD CONSTRAINT FK_80071925ACC14410 FOREIGN KEY (fire_jacket_id) REFERENCES detail_size (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE measure DROP FOREIGN KEY FK_800719251B196FF4');
        $this->addSql('ALTER TABLE measure DROP FOREIGN KEY FK_800719257745528D');
        $this->addSql('ALTER TABLE measure DROP FOREIGN KEY FK_80071925EF044C42');
        $this->addSql('ALTER TABLE measure DROP FOREIGN KEY FK_800719254F74C967');
        $this->addSql('ALTER TABLE measure DROP FOREIGN KEY FK_80071925ACC14410');
        $this->addSql('DROP TABLE detail_size');
        $this->addSql('DROP TABLE measure');
    }
}
