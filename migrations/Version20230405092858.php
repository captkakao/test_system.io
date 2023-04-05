<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230405092858 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE "country_taxes_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE "country_taxes" (id INT NOT NULL, country_id INT NOT NULL, tax_percentage DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_656EB212F92F3E70 ON "country_taxes" (country_id)');
        $this->addSql('ALTER TABLE "country_taxes" ADD CONSTRAINT FK_656EB212F92F3E70 FOREIGN KEY (country_id) REFERENCES "countries" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE "country_taxes_id_seq" CASCADE');
        $this->addSql('ALTER TABLE "country_taxes" DROP CONSTRAINT FK_656EB212F92F3E70');
        $this->addSql('DROP TABLE "country_taxes"');
    }
}
