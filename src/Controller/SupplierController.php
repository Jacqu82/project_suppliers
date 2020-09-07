<?php

declare(strict_types=1);

namespace App\Controller;

use App\Form\SupplierType;
use App\Manager\SupplierManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @author Jacek Wesołowski <jacqu25@yahoo.com>
 */
class SupplierController extends AbstractController
{
    /**
     * @var SupplierManager
     */
    private $supplierManager;

    public function __construct(SupplierManager $supplierManager)
    {
        $this->supplierManager = $supplierManager;
    }

    /**
     * @Route("/supplier/new", name="supplier_new")
     *
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $form = $this->createForm(SupplierType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->supplierManager->create($form);
        }

        return $this->render(
            'supplier/new.html.twig',
            [
                'form' => $form->createView()
            ]
        );
    }
}
