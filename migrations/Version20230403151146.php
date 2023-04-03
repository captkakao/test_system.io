<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230403151146 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE store_owner_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE store_owner (id INT NOT NULL, store_id INT NOT NULL, owner_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B35EB065B092A811 ON store_owner (store_id)');
        $this->addSql('CREATE INDEX IDX_B35EB0657E3C61F9 ON store_owner (owner_id)');
        $this->addSql('ALTER TABLE store_owner ADD CONSTRAINT FK_B35EB065B092A811 FOREIGN KEY (store_id) REFERENCES "stores" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE store_owner ADD CONSTRAINT FK_B35EB0657E3C61F9 FOREIGN KEY (owner_id) REFERENCES "users" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE products DROP CONSTRAINT FK_B3BA5A5A37AC84E');
        $this->addSql('DROP INDEX UNIQ_B3BA5A5A37AC84E');
        $this->addSql('ALTER TABLE products RENAME COLUMN store_id TO store_id_id');
        $this->addSql('ALTER TABLE products ADD CONSTRAINT FK_B3BA5A5A37AC84E FOREIGN KEY (store_id_id) REFERENCES "stores" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B3BA5A5A37AC84E ON products (store_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE store_owner_id_seq CASCADE');
        $this->addSql('ALTER TABLE store_owner DROP CONSTRAINT FK_B35EB065B092A811');
        $this->addSql('ALTER TABLE store_owner DROP CONSTRAINT FK_B35EB0657E3C61F9');
        $this->addSql('DROP TABLE store_owner');
        $this->addSql('ALTER TABLE "products" DROP CONSTRAINT fk_b3ba5a5a37ac84e');
        $this->addSql('DROP INDEX uniq_b3ba5a5a37ac84e');
        $this->addSql('ALTER TABLE "products" RENAME COLUMN store_id_id TO store_id');
        $this->addSql('ALTER TABLE "products" ADD CONSTRAINT fk_b3ba5a5a37ac84e FOREIGN KEY (store_id) REFERENCES stores (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX uniq_b3ba5a5a37ac84e ON "products" (store_id)');
    }
}
