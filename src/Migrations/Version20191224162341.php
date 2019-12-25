<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191224162341 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE measure');
        $this->addSql('ALTER TABLE candidate ADD waiting_pants_id INT DEFAULT NULL, ADD fire_pants_id INT DEFAULT NULL, ADD sweat_id INT DEFAULT NULL, ADD teeshirt_id INT DEFAULT NULL, ADD fire_jacket_id INT DEFAULT NULL, ADD rubber_boots SMALLINT DEFAULT NULL, ADD ranger_boots SMALLINT DEFAULT NULL, ADD fire_gloves SMALLINT DEFAULT NULL');
        $this->addSql('ALTER TABLE candidate ADD CONSTRAINT FK_C8B28E441B196FF4 FOREIGN KEY (waiting_pants_id) REFERENCES detail_size (id)');
        $this->addSql('ALTER TABLE candidate ADD CONSTRAINT FK_C8B28E447745528D FOREIGN KEY (fire_pants_id) REFERENCES detail_size (id)');
        $this->addSql('ALTER TABLE candidate ADD CONSTRAINT FK_C8B28E44EF044C42 FOREIGN KEY (sweat_id) REFERENCES detail_size (id)');
        $this->addSql('ALTER TABLE candidate ADD CONSTRAINT FK_C8B28E444F74C967 FOREIGN KEY (teeshirt_id) REFERENCES detail_size (id)');
        $this->addSql('ALTER TABLE candidate ADD CONSTRAINT FK_C8B28E44ACC14410 FOREIGN KEY (fire_jacket_id) REFERENCES detail_size (id)');
        $this->addSql('CREATE INDEX IDX_C8B28E441B196FF4 ON candidate (waiting_pants_id)');
        $this->addSql('CREATE INDEX IDX_C8B28E447745528D ON candidate (fire_pants_id)');
        $this->addSql('CREATE INDEX IDX_C8B28E44EF044C42 ON candidate (sweat_id)');
        $this->addSql('CREATE INDEX IDX_C8B28E444F74C967 ON candidate (teeshirt_id)');
        $this->addSql('CREATE INDEX IDX_C8B28E44ACC14410 ON candidate (fire_jacket_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE measure (id INT AUTO_INCREMENT NOT NULL, candidate_id INT NOT NULL, waiting_pants_id INT DEFAULT NULL, fire_pants_id INT DEFAULT NULL, sweat_id INT DEFAULT NULL, teeshirt_id INT DEFAULT NULL, fire_jacket_id INT DEFAULT NULL, rubber_boots SMALLINT DEFAULT NULL, ranger_boots SMALLINT DEFAULT NULL, fire_gloves SMALLINT DEFAULT NULL, INDEX IDX_800719251B196FF4 (waiting_pants_id), INDEX IDX_80071925EF044C42 (sweat_id), INDEX IDX_80071925ACC14410 (fire_jacket_id), UNIQUE INDEX UNIQ_8007192591BD8781 (candidate_id), INDEX IDX_800719257745528D (fire_pants_id), INDEX IDX_800719254F74C967 (teeshirt_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE measure ADD CONSTRAINT FK_800719251B196FF4 FOREIGN KEY (waiting_pants_id) REFERENCES detail_size (id)');
        $this->addSql('ALTER TABLE measure ADD CONSTRAINT FK_800719254F74C967 FOREIGN KEY (teeshirt_id) REFERENCES detail_size (id)');
        $this->addSql('ALTER TABLE measure ADD CONSTRAINT FK_800719257745528D FOREIGN KEY (fire_pants_id) REFERENCES detail_size (id)');
        $this->addSql('ALTER TABLE measure ADD CONSTRAINT FK_8007192591BD8781 FOREIGN KEY (candidate_id) REFERENCES candidate (id)');
        $this->addSql('ALTER TABLE measure ADD CONSTRAINT FK_80071925ACC14410 FOREIGN KEY (fire_jacket_id) REFERENCES detail_size (id)');
        $this->addSql('ALTER TABLE measure ADD CONSTRAINT FK_80071925EF044C42 FOREIGN KEY (sweat_id) REFERENCES detail_size (id)');
        $this->addSql('ALTER TABLE candidate DROP FOREIGN KEY FK_C8B28E441B196FF4');
        $this->addSql('ALTER TABLE candidate DROP FOREIGN KEY FK_C8B28E447745528D');
        $this->addSql('ALTER TABLE candidate DROP FOREIGN KEY FK_C8B28E44EF044C42');
        $this->addSql('ALTER TABLE candidate DROP FOREIGN KEY FK_C8B28E444F74C967');
        $this->addSql('ALTER TABLE candidate DROP FOREIGN KEY FK_C8B28E44ACC14410');
        $this->addSql('DROP INDEX IDX_C8B28E441B196FF4 ON candidate');
        $this->addSql('DROP INDEX IDX_C8B28E447745528D ON candidate');
        $this->addSql('DROP INDEX IDX_C8B28E44EF044C42 ON candidate');
        $this->addSql('DROP INDEX IDX_C8B28E444F74C967 ON candidate');
        $this->addSql('DROP INDEX IDX_C8B28E44ACC14410 ON candidate');
        $this->addSql('ALTER TABLE candidate DROP waiting_pants_id, DROP fire_pants_id, DROP sweat_id, DROP teeshirt_id, DROP fire_jacket_id, DROP rubber_boots, DROP ranger_boots, DROP fire_gloves');
    }
}
