<?php

declare(strict_types=1);

namespace Authentication\Resources\Persistence\Doctrine\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190327085817 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE Clients (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE Settings ADD client_id INT DEFAULT NULL, DROP client');
        $this->addSql('ALTER TABLE Settings ADD CONSTRAINT FK_1C33C29319EB6921 FOREIGN KEY (client_id) REFERENCES Clients (id)');
        $this->addSql('CREATE INDEX IDX_1C33C29319EB6921 ON Settings (client_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE Settings DROP FOREIGN KEY FK_1C33C29319EB6921');
        $this->addSql('DROP TABLE Clients');
        $this->addSql('DROP INDEX IDX_1C33C29319EB6921 ON Settings');
        $this->addSql('ALTER TABLE Settings ADD client VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, DROP client_id');
    }
}
