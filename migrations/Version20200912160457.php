<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20200912160457 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        $this->addSql('ALTER TABLE warehouse DROP FOREIGN KEY FK_ECB38BFC2ADD6D8C');
        $this->addSql('ALTER TABLE warehouse ADD CONSTRAINT FK_ECB38BFC2ADD6D8C FOREIGN KEY (supplier_id) REFERENCES supplier (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        $this->addSql('ALTER TABLE warehouse DROP FOREIGN KEY FK_ECB38BFC2ADD6D8C');
        $this->addSql('ALTER TABLE warehouse ADD CONSTRAINT FK_ECB38BFC2ADD6D8C FOREIGN KEY (supplier_id) REFERENCES supplier (id)');
    }
}
