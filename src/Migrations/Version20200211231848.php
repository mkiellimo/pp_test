<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200211231848 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE orders (id INT AUTO_INCREMENT NOT NULL, order_id VARCHAR(255) NOT NULL, phone VARCHAR(50) NOT NULL, shipping_status VARCHAR(50) NOT NULL, shipping_price NUMERIC(10, 2) NOT NULL, shipping_payment_status VARCHAR(50) NOT NULL, payment_status VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE orders_item (id INT AUTO_INCREMENT NOT NULL, orders_id INT NOT NULL, barcode VARCHAR(255) NOT NULL, price NUMERIC(12, 2) NOT NULL, cost NUMERIC(12, 2) NOT NULL, tax_perc SMALLINT NOT NULL, tax_amt NUMERIC(12, 2) NOT NULL, quantity INT NOT NULL, tracking_number VARCHAR(255) NOT NULL, canceled VARCHAR(50) NOT NULL, shipped_status_sku VARCHAR(50) NOT NULL, INDEX IDX_B1CEE4B5CFFE9AD6 (orders_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE orders_item ADD CONSTRAINT FK_B1CEE4B5CFFE9AD6 FOREIGN KEY (orders_id) REFERENCES orders (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE orders_item DROP FOREIGN KEY FK_B1CEE4B5CFFE9AD6');
        $this->addSql('DROP TABLE orders');
        $this->addSql('DROP TABLE orders_item');
    }
}
