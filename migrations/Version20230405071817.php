<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230405071817 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE basket_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE basket (id INT NOT NULL, buser_id INT NOT NULL, good_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_2246507BCDEE7444 ON basket (buser_id)');
        $this->addSql('CREATE INDEX IDX_2246507B1CF98C70 ON basket (good_id)');
        $this->addSql('ALTER TABLE basket ADD CONSTRAINT FK_2246507BCDEE7444 FOREIGN KEY (buser_id) REFERENCES "users" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE basket ADD CONSTRAINT FK_2246507B1CF98C70 FOREIGN KEY (good_id) REFERENCES "goods" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE basket_id_seq CASCADE');
        $this->addSql('ALTER TABLE basket DROP CONSTRAINT FK_2246507BCDEE7444');
        $this->addSql('ALTER TABLE basket DROP CONSTRAINT FK_2246507B1CF98C70');
        $this->addSql('DROP TABLE basket');
    }
}
