<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210523174420 extends AbstractMigration
{
    /**
     * @return string
     */
    public function getDescription(): string
    {
        return '';
    }

    /**
     * @param Schema $schema
     */
    public function up(Schema $schema): void
    {
        $this->addSql('
            CREATE TABLE asteroid (
                id INT AUTO_INCREMENT NOT NULL,
                date DATE NOT NULL,
                reference INT NOT NULL,
                name VARCHAR(255) NOT NULL,
                is_hazardous TINYINT(1) NOT NULL,
                speed NUMERIC(20, 10) NOT NULL,
                PRIMARY KEY(id)
            )
            DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB'
        );
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE asteroid');
    }
}
