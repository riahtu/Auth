<?php

declare(strict_types=1);

namespace Authentication\Resources\Persistence\Doctrine\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190327115934 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE AccessTokens ADD client_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE AccessTokens ADD CONSTRAINT FK_D66A5F8F19EB6921 FOREIGN KEY (client_id) REFERENCES Clients (id)');
        $this->addSql('CREATE INDEX IDX_D66A5F8F19EB6921 ON AccessTokens (client_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE AccessTokens DROP FOREIGN KEY FK_D66A5F8F19EB6921');
        $this->addSql('DROP INDEX IDX_D66A5F8F19EB6921 ON AccessTokens');
        $this->addSql('ALTER TABLE AccessTokens DROP client_id');
    }
}
