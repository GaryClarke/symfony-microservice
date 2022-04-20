<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220420135640 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE product (
                    id INT AUTO_INCREMENT NOT NULL, 
                    price INT NOT NULL, 
                    PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');

        $this->addSql('CREATE TABLE product_promotion (
                    id INT AUTO_INCREMENT NOT NULL, 
                    product_id INT NOT NULL, 
                    promotion_id INT NOT NULL, 
                    valid_to DATETIME DEFAULT NULL, 
                    INDEX IDX_AFBDCB5C4584665A (product_id), 
                    INDEX IDX_AFBDCB5C139DF194 (promotion_id), 
                    PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');

        $this->addSql('CREATE TABLE promotion (
                    id INT AUTO_INCREMENT NOT NULL, 
                    name VARCHAR(255) NOT NULL, 
                    type VARCHAR(255) NOT NULL, 
                    adjustment DOUBLE PRECISION NOT NULL, 
                    criteria JSON NOT NULL, 
                    PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');

        $this->addSql('ALTER TABLE product_promotion ADD CONSTRAINT FK_AFBDCB5C4584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE product_promotion ADD CONSTRAINT FK_AFBDCB5C139DF194 FOREIGN KEY (promotion_id) REFERENCES promotion (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product_promotion DROP FOREIGN KEY FK_AFBDCB5C4584665A');
        $this->addSql('ALTER TABLE product_promotion DROP FOREIGN KEY FK_AFBDCB5C139DF194');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE product_promotion');
        $this->addSql('DROP TABLE promotion');
    }
}
