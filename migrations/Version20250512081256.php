<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250512081256 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE manufacturer (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE vehicle_information ADD manufacturer_id INT NOT NULL, CHANGE registration_date registration_date DATE NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE vehicle_information ADD CONSTRAINT FK_A74265F5A23B42D FOREIGN KEY (manufacturer_id) REFERENCES manufacturer (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_A74265F5A23B42D ON vehicle_information (manufacturer_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE vehicle_information DROP FOREIGN KEY FK_A74265F5A23B42D
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE manufacturer
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_A74265F5A23B42D ON vehicle_information
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE vehicle_information DROP manufacturer_id, CHANGE registration_date registration_date DATE DEFAULT '2010-10-10' NOT NULL
        SQL);
    }
}
