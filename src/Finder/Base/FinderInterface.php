<?php

declare(strict_types=1);

namespace App\Finder\Base;

/**
 * @author Jacek Wesołowski <jacqu25@yahoo.com>
 */
interface FinderInterface
{
    public function getAlias(): string;

    public function getTable(): string;

    public function getAll(): array;

    public function get(int $id): array;
}
