<?php

declare(strict_types=1);

namespace App\Finder;

use App\Finder\Base\AbstractFinder;
use App\Finder\Base\FinderInterface;
use PDO;

/**
 * @author Jacek Wesołowski <jacqu25@yahoo.com>
 */
class WarehouseFinder extends AbstractFinder implements FinderInterface
{
    public function getAlias(): string
    {
        return 'w';
    }

    public function getTable(): string
    {
        return 'warehouse';
    }

    public function getAll(): array
    {
        $queryBuilder = $this->createQueryBuilder();
        $queryBuilder
            ->select(sprintf('%s.*, s.name as supplier_name', $this->getAlias()))
            ->from($this->getTable(), $this->getAlias())
            ->join($this->getAlias(), 'supplier', 's', sprintf('%s.supplier_id = s.id', $this->getAlias()));

        return $queryBuilder->execute()->fetchAll();
    }

    public function get(int $id): array
    {
        $queryBuilder = $this->createQueryBuilder();
        $queryBuilder
            ->select(sprintf('%s.*, s.name as supplier_name', $this->getAlias()))
            ->from($this->getTable(), $this->getAlias())
            ->join($this->getAlias(), 'supplier', 's', sprintf('%s.supplier_id = s.id', $this->getAlias()))
            ->andWhere(sprintf('%s.id = :id', $this->getAlias()))
            ->setParameter('id', $id, PDO::PARAM_INT);

        return $queryBuilder->execute()->fetch(PDO::FETCH_ASSOC);
    }

    public function countAll()
    {
        $queryBuilder = $this->createQueryBuilder();
        $queryBuilder
            ->select('COUNT(id) as count')
            ->from($this->getTable(), $this->getAlias());

        return $queryBuilder->execute()->fetch(PDO::FETCH_COLUMN);
    }

    public function getBySupplier(int $supplierId)
    {
        $queryBuilder = $this->createQueryBuilder();
        $queryBuilder
            ->select(sprintf('%s.name', $this->getAlias()))
            ->from($this->getTable(), $this->getAlias())
            ->andWhere('w.supplier_id = :supplierId')
            ->setParameter('supplierId', $supplierId);

        return $queryBuilder->execute()->fetchAll();
    }
}
