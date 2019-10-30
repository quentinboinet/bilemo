<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191030130614 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE client_mobile');
        $this->addSql('ALTER TABLE mobile ADD stock INT NOT NULL, ADD price DOUBLE PRECISION NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE client_mobile (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, mobile_id INT NOT NULL, stock INT NOT NULL, price DOUBLE PRECISION NOT NULL, INDEX IDX_69D56853B806424B (mobile_id), INDEX IDX_69D5685319EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE client_mobile ADD CONSTRAINT FK_69D5685319EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE client_mobile ADD CONSTRAINT FK_69D56853B806424B FOREIGN KEY (mobile_id) REFERENCES mobile (id)');
        $this->addSql('ALTER TABLE mobile DROP stock, DROP price');
    }
}
