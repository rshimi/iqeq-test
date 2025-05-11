<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250511093818 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create Vehicle Information table';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE vehicle_information (
                id INT AUTO_INCREMENT NOT NULL, 
                make VARCHAR(255) NOT NULL,
                model VARCHAR(255) NOT NULL,
                year INT NOT NULL,
                colour VARCHAR(255) NOT NULL,
                type VARCHAR(255) NOT NULL,
                vehicle_identification_number VARCHAR(17) NOT NULL, 
                registration_date DATE NOT NULL, 
                licence_plate VARCHAR(12) NOT NULL, 
                country VARCHAR(2) NOT NULL, 
                PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            DROP TABLE vehicle_information
        SQL);
    }
}
