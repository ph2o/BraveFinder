<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201009213222 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE candidate (id INT AUTO_INCREMENT NOT NULL, waiting_pants_id INT DEFAULT NULL, fire_pants_id INT DEFAULT NULL, sweat_id INT DEFAULT NULL, teeshirt_id INT DEFAULT NULL, fire_jacket_id INT DEFAULT NULL, path_way_id INT DEFAULT NULL, title_id INT DEFAULT NULL, marital_status_id INT DEFAULT NULL, station_id INT DEFAULT NULL, head_circumference_id INT DEFAULT NULL, name VARCHAR(50) NOT NULL, firstname VARCHAR(50) NOT NULL, birthdate DATE DEFAULT NULL, phone VARCHAR(13) DEFAULT NULL, mobile VARCHAR(13) DEFAULT NULL, street VARCHAR(50) DEFAULT NULL, house_number VARCHAR(5) DEFAULT NULL, zip VARCHAR(5) DEFAULT NULL, city VARCHAR(50) DEFAULT NULL, mail VARCHAR(50) DEFAULT NULL, mail_pro VARCHAR(50) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, picture VARCHAR(255) DEFAULT NULL, on_site TINYINT(1) NOT NULL, rubber_boots SMALLINT DEFAULT NULL, ranger_boots SMALLINT DEFAULT NULL, fire_gloves SMALLINT DEFAULT NULL, social_number VARCHAR(16) DEFAULT NULL, origin_name VARCHAR(255) DEFAULT NULL, iban VARCHAR(50) DEFAULT NULL, bank_name VARCHAR(50) DEFAULT NULL, education LONGTEXT DEFAULT NULL, INDEX IDX_C8B28E441B196FF4 (waiting_pants_id), INDEX IDX_C8B28E447745528D (fire_pants_id), INDEX IDX_C8B28E44EF044C42 (sweat_id), INDEX IDX_C8B28E444F74C967 (teeshirt_id), INDEX IDX_C8B28E44ACC14410 (fire_jacket_id), INDEX IDX_C8B28E44ED1EAC68 (path_way_id), INDEX IDX_C8B28E44A9F87BD (title_id), INDEX IDX_C8B28E44E559F9BF (marital_status_id), INDEX IDX_C8B28E4421BDB235 (station_id), INDEX IDX_C8B28E44E0FFF435 (head_circumference_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE csv_file (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE detail_size (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(15) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE evaluation (id INT AUTO_INCREMENT NOT NULL, candidate_id INT NOT NULL, practice_id INT NOT NULL, rate INT DEFAULT NULL, comment LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_1323A57591BD8781 (candidate_id), INDEX IDX_1323A575ED33821 (practice_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE marital_status (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE path_way (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(15) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE practice (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, description LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, group_allowed VARCHAR(50) DEFAULT NULL, interview TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE size (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(15) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE station (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE title (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(15) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE candidate ADD CONSTRAINT FK_C8B28E441B196FF4 FOREIGN KEY (waiting_pants_id) REFERENCES detail_size (id)');
        $this->addSql('ALTER TABLE candidate ADD CONSTRAINT FK_C8B28E447745528D FOREIGN KEY (fire_pants_id) REFERENCES size (id)');
        $this->addSql('ALTER TABLE candidate ADD CONSTRAINT FK_C8B28E44EF044C42 FOREIGN KEY (sweat_id) REFERENCES size (id)');
        $this->addSql('ALTER TABLE candidate ADD CONSTRAINT FK_C8B28E444F74C967 FOREIGN KEY (teeshirt_id) REFERENCES size (id)');
        $this->addSql('ALTER TABLE candidate ADD CONSTRAINT FK_C8B28E44ACC14410 FOREIGN KEY (fire_jacket_id) REFERENCES size (id)');
        $this->addSql('ALTER TABLE candidate ADD CONSTRAINT FK_C8B28E44ED1EAC68 FOREIGN KEY (path_way_id) REFERENCES path_way (id)');
        $this->addSql('ALTER TABLE candidate ADD CONSTRAINT FK_C8B28E44A9F87BD FOREIGN KEY (title_id) REFERENCES title (id)');
        $this->addSql('ALTER TABLE candidate ADD CONSTRAINT FK_C8B28E44E559F9BF FOREIGN KEY (marital_status_id) REFERENCES marital_status (id)');
        $this->addSql('ALTER TABLE candidate ADD CONSTRAINT FK_C8B28E4421BDB235 FOREIGN KEY (station_id) REFERENCES station (id)');
        $this->addSql('ALTER TABLE candidate ADD CONSTRAINT FK_C8B28E44E0FFF435 FOREIGN KEY (head_circumference_id) REFERENCES size (id)');
        $this->addSql('ALTER TABLE evaluation ADD CONSTRAINT FK_1323A57591BD8781 FOREIGN KEY (candidate_id) REFERENCES candidate (id)');
        $this->addSql('ALTER TABLE evaluation ADD CONSTRAINT FK_1323A575ED33821 FOREIGN KEY (practice_id) REFERENCES practice (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE evaluation DROP FOREIGN KEY FK_1323A57591BD8781');
        $this->addSql('ALTER TABLE candidate DROP FOREIGN KEY FK_C8B28E441B196FF4');
        $this->addSql('ALTER TABLE candidate DROP FOREIGN KEY FK_C8B28E44E559F9BF');
        $this->addSql('ALTER TABLE candidate DROP FOREIGN KEY FK_C8B28E44ED1EAC68');
        $this->addSql('ALTER TABLE evaluation DROP FOREIGN KEY FK_1323A575ED33821');
        $this->addSql('ALTER TABLE candidate DROP FOREIGN KEY FK_C8B28E447745528D');
        $this->addSql('ALTER TABLE candidate DROP FOREIGN KEY FK_C8B28E44EF044C42');
        $this->addSql('ALTER TABLE candidate DROP FOREIGN KEY FK_C8B28E444F74C967');
        $this->addSql('ALTER TABLE candidate DROP FOREIGN KEY FK_C8B28E44ACC14410');
        $this->addSql('ALTER TABLE candidate DROP FOREIGN KEY FK_C8B28E44E0FFF435');
        $this->addSql('ALTER TABLE candidate DROP FOREIGN KEY FK_C8B28E4421BDB235');
        $this->addSql('ALTER TABLE candidate DROP FOREIGN KEY FK_C8B28E44A9F87BD');
        $this->addSql('DROP TABLE candidate');
        $this->addSql('DROP TABLE csv_file');
        $this->addSql('DROP TABLE detail_size');
        $this->addSql('DROP TABLE evaluation');
        $this->addSql('DROP TABLE marital_status');
        $this->addSql('DROP TABLE path_way');
        $this->addSql('DROP TABLE practice');
        $this->addSql('DROP TABLE size');
        $this->addSql('DROP TABLE station');
        $this->addSql('DROP TABLE title');
        $this->addSql('DROP TABLE user');
    }
}
