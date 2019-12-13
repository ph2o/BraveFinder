<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191213175009 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE practice DROP evaluation_id');
        $this->addSql('ALTER TABLE evaluation ADD practice_id INT NOT NULL');
        $this->addSql('ALTER TABLE evaluation ADD CONSTRAINT FK_1323A575ED33821 FOREIGN KEY (practice_id) REFERENCES practice (id)');
        $this->addSql('CREATE INDEX IDX_1323A575ED33821 ON evaluation (practice_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE evaluation DROP FOREIGN KEY FK_1323A575ED33821');
        $this->addSql('DROP INDEX IDX_1323A575ED33821 ON evaluation');
        $this->addSql('ALTER TABLE evaluation DROP practice_id');
        $this->addSql('ALTER TABLE practice ADD evaluation_id INT NOT NULL');
    }
}
