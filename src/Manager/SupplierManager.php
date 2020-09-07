<?php

declare(strict_types=1);

namespace App\Manager;

use App\Entity\Supplier;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;

/**
 * @author Jacek Wesołowski <jacqu25@yahoo.com>
 */
class SupplierManager
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function create(FormInterface $form): void
    {
        /** @var Supplier $supplier */
        $supplier = $form->getData();
        $supplier->setCode(strtoupper($form->get('name')->getData()));
        $supplier->setPrefix(strtoupper(substr($form->get('name')->getData(), 0, 2)));

        $this->entityManager->persist($supplier);
        $this->entityManager->flush();
    }
}
