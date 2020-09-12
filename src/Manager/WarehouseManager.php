<?php

declare(strict_types=1);

namespace App\Manager;

use App\Entity\Warehouse;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;

/**
 * @author Jacek Wesołowski <jacqu25@yahoo.com>
 */
class WarehouseManager
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function create(FormInterface $form, bool $persist = false): void
    {
        /** @var Warehouse $warehouse */
        $warehouse = $form->getData();

        if (true === $persist) {
            $this->entityManager->persist($warehouse);
        }

        $this->entityManager->flush();
    }
}
