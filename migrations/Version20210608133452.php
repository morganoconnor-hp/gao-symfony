<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210608133452 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE attribution DROP CONSTRAINT fk_c751ed498b870e04');
        $this->addSql('ALTER TABLE attribution DROP CONSTRAINT fk_c751ed49bc3418ef');
        $this->addSql('DROP INDEX idx_c751ed498b870e04');
        $this->addSql('DROP INDEX idx_c751ed49bc3418ef');
        $this->addSql('ALTER TABLE attribution ADD customer_id INT NOT NULL');
        $this->addSql('ALTER TABLE attribution ADD computer_id INT NOT NULL');
        $this->addSql('ALTER TABLE attribution DROP id_customer_id');
        $this->addSql('ALTER TABLE attribution DROP id_computer_id');
        $this->addSql('ALTER TABLE attribution ADD CONSTRAINT FK_C751ED499395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE attribution ADD CONSTRAINT FK_C751ED49A426D518 FOREIGN KEY (computer_id) REFERENCES computer (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_C751ED499395C3F3 ON attribution (customer_id)');
        $this->addSql('CREATE INDEX IDX_C751ED49A426D518 ON attribution (computer_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE attribution DROP CONSTRAINT FK_C751ED499395C3F3');
        $this->addSql('ALTER TABLE attribution DROP CONSTRAINT FK_C751ED49A426D518');
        $this->addSql('DROP INDEX IDX_C751ED499395C3F3');
        $this->addSql('DROP INDEX IDX_C751ED49A426D518');
        $this->addSql('ALTER TABLE attribution ADD id_customer_id INT NOT NULL');
        $this->addSql('ALTER TABLE attribution ADD id_computer_id INT NOT NULL');
        $this->addSql('ALTER TABLE attribution DROP customer_id');
        $this->addSql('ALTER TABLE attribution DROP computer_id');
        $this->addSql('ALTER TABLE attribution ADD CONSTRAINT fk_c751ed498b870e04 FOREIGN KEY (id_customer_id) REFERENCES customer (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE attribution ADD CONSTRAINT fk_c751ed49bc3418ef FOREIGN KEY (id_computer_id) REFERENCES computer (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_c751ed498b870e04 ON attribution (id_customer_id)');
        $this->addSql('CREATE INDEX idx_c751ed49bc3418ef ON attribution (id_computer_id)');
    }
}
