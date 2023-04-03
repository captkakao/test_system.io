<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230403141044 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE "products_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "stores_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE "products" (id INT NOT NULL, store_id INT NOT NULL, name VARCHAR(255) NOT NULL, description TEXT NOT NULL, price DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B3BA5A5A37AC84E ON "products" (store_id)');
        $this->addSql('CREATE TABLE "stores" (id INT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE "products" ADD CONSTRAINT FK_B3BA5A5A37AC84E FOREIGN KEY (store_id) REFERENCES "stores" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE "products_id_seq" CASCADE');
        $this->addSql('DROP SEQUENCE "stores_id_seq" CASCADE');
        $this->addSql('ALTER TABLE "products" DROP CONSTRAINT FK_B3BA5A5A37AC84E');
        $this->addSql('DROP TABLE "products"');
        $this->addSql('DROP TABLE "stores"');
    }
}
