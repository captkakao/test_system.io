<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230405043630 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE "goods_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "shops_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE "goods" (id INT NOT NULL, shop_id INT NOT NULL, name VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_563B92D4D16C4DD ON "goods" (shop_id)');
        $this->addSql('CREATE TABLE "shops" (id INT NOT NULL, name VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE "goods" ADD CONSTRAINT FK_563B92D4D16C4DD FOREIGN KEY (shop_id) REFERENCES "shops" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE "goods_id_seq" CASCADE');
        $this->addSql('DROP SEQUENCE "shops_id_seq" CASCADE');
        $this->addSql('ALTER TABLE "goods" DROP CONSTRAINT FK_563B92D4D16C4DD');
        $this->addSql('DROP TABLE "goods"');
        $this->addSql('DROP TABLE "shops"');
    }
}
