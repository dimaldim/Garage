<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191213132028 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE vehicle CHANGE date_added date_added DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL');
        $this->addSql('ALTER TABLE vehicle_activity ADD vehicle_id INT NOT NULL');
        $this->addSql('ALTER TABLE vehicle_activity ADD CONSTRAINT FK_716606CE545317D1 FOREIGN KEY (vehicle_id) REFERENCES vehicle (id)');
        $this->addSql('CREATE INDEX IDX_716606CE545317D1 ON vehicle_activity (vehicle_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`');
        $this->addSql('ALTER TABLE vehicle CHANGE date_added date_added DATE DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE vehicle_activity DROP FOREIGN KEY FK_716606CE545317D1');
        $this->addSql('DROP INDEX IDX_716606CE545317D1 ON vehicle_activity');
        $this->addSql('ALTER TABLE vehicle_activity DROP vehicle_id');
    }
}
