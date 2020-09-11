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
    public function getAll(): array
    {
        $queryBuilder = $this->createQueryBuilder();
        $queryBuilder
            ->select('s.*')
            ->from('supplier', 's');

        return $queryBuilder->execute()->fetchAll();
    }

    public function get(int $id): array
    {
        $queryBuilder = $this->createQueryBuilder();
        $queryBuilder
            ->select('s.*')
            ->from('supplier', 's')
            ->andWhere('s.id = :id')
            ->setParameter('id', $id, PDO::PARAM_INT);

        return $queryBuilder->execute()->fetch(PDO::FETCH_ASSOC);
    }

    public function countAll()
    {
        $queryBuilder = $this->createQueryBuilder();
        $queryBuilder
            ->select('COUNT(id) as count')
            ->from('supplier', 's');

        return $queryBuilder->execute()->fetch(PDO::FETCH_COLUMN);
    }
}
