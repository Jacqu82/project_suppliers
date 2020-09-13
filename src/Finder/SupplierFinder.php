<?php

declare(strict_types=1);

namespace App\Finder;

use App\Finder\Base\AbstractFinder;
use App\Finder\Base\FinderInterface;
use PDO;

/**
 * @author Jacek Wesołowski <jacqu25@yahoo.com>
 */
class SupplierFinder extends AbstractFinder implements FinderInterface
{
    public function getAlias(): string
    {
        return 's';
    }

    public function getTable(): string
    {
        return 'supplier';
    }

    public function getAll(): array
    {
        $queryBuilder = $this->createQueryBuilder();
        $queryBuilder
            ->select(sprintf('%s.*', $this->getAlias()))
            ->from($this->getTable(), $this->getAlias());

        return $queryBuilder->execute()->fetchAll();
    }

    public function get(int $id): array
    {
        $queryBuilder = $this->createQueryBuilder();
        $queryBuilder
            ->select(sprintf('%s.*', $this->getAlias()))
            ->from($this->getTable(), $this->getAlias())
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
}
