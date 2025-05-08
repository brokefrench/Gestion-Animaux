<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250426161410 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE animal (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom_commun VARCHAR(255) NOT NULL, nom_savant VARCHAR(255) NOT NULL, embranchement VARCHAR(255) NOT NULL, classe VARCHAR(255) NOT NULL, ordre VARCHAR(255) NOT NULL, sous_ordre VARCHAR(255) NOT NULL, famille VARCHAR(255) NOT NULL, genre VARCHAR(255) NOT NULL, status_conservation VARCHAR(2) NOT NULL, description VARCHAR(255) NOT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE observation (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, id_animal_id INTEGER NOT NULL, user_id INTEGER DEFAULT NULL, date DATETIME NOT NULL, latitude DOUBLE PRECISION NOT NULL, longitude DOUBLE PRECISION NOT NULL, description VARCHAR(255) NOT NULL, CONSTRAINT FK_C576DBE0EA39031 FOREIGN KEY (id_animal_id) REFERENCES animal (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_C576DBE0A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_C576DBE0EA39031 ON observation (id_animal_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_C576DBE0A76ED395 ON observation (user_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
            , password VARCHAR(255) NOT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL ON user (email)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            DROP TABLE animal
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE observation
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE user
        SQL);
    }
}
