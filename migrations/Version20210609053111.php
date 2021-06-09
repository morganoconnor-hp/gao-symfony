<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210609053111 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE attribution (id INT NOT NULL, customer_id INT NOT NULL, computer_id INT NOT NULL, date DATE NOT NULL, schedule VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_C751ED499395C3F3 ON attribution (customer_id)');
        $this->addSql('CREATE INDEX IDX_C751ED49A426D518 ON attribution (computer_id)');
        $this->addSql('CREATE TABLE computer (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE customer (id INT NOT NULL, lastname VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE attribution ADD CONSTRAINT FK_C751ED499395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE attribution ADD CONSTRAINT FK_C751ED49A426D518 FOREIGN KEY (computer_id) REFERENCES computer (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE attribution DROP CONSTRAINT FK_C751ED49A426D518');
        $this->addSql('ALTER TABLE attribution DROP CONSTRAINT FK_C751ED499395C3F3');
        $this->addSql('DROP TABLE attribution');
        $this->addSql('DROP TABLE computer');
        $this->addSql('DROP TABLE customer');
    }
}
