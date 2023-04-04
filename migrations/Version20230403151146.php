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
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE store_owner_id_seq CASCADE');
        $this->addSql('ALTER TABLE store_owner DROP CONSTRAINT FK_B35EB065B092A811');
        $this->addSql('ALTER TABLE store_owner DROP CONSTRAINT FK_B35EB0657E3C61F9');
        $this->addSql('DROP TABLE store_owner');
    }
}
