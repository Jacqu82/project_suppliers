<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20200912071001 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $this->addSql(
            'CREATE TABLE warehouse (id INT AUTO_INCREMENT NOT NULL, supplier_id INT NOT NULL, name VARCHAR(50) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_ECB38BFC2ADD6D8C (supplier_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB'
        );
        $this->addSql(
            'CREATE TABLE source (id INT AUTO_INCREMENT NOT NULL, warehouse_id INT DEFAULT NULL, supplier_id INT NOT NULL, name VARCHAR(50) NOT NULL, data_format VARCHAR(20) NOT NULL, deleted_at DATETIME DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_5F8A7F735080ECDE (warehouse_id), INDEX IDX_5F8A7F732ADD6D8C (supplier_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB'
        );
        $this->addSql(
            'ALTER TABLE warehouse ADD CONSTRAINT FK_ECB38BFC2ADD6D8C FOREIGN KEY (supplier_id) REFERENCES supplier (id)'
        );
        $this->addSql(
            'ALTER TABLE source ADD CONSTRAINT FK_5F8A7F735080ECDE FOREIGN KEY (warehouse_id) REFERENCES warehouse (id)'
        );
        $this->addSql(
            'ALTER TABLE source ADD CONSTRAINT FK_5F8A7F732ADD6D8C FOREIGN KEY (supplier_id) REFERENCES supplier (id)'
        );
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE source DROP FOREIGN KEY FK_5F8A7F735080ECDE');
        $this->addSql('DROP TABLE source');
        $this->addSql('DROP TABLE warehouse');
    }
}
