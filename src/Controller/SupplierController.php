<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Supplier;
use App\Finder\SupplierFinder;
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

    /**
     * @var SupplierFinder
     */
    private $supplierFinder;

    public function __construct(SupplierManager $supplierManager, SupplierFinder $supplierFinder)
    {
        $this->supplierManager = $supplierManager;
        $this->supplierFinder = $supplierFinder;
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
            $this->supplierManager->create($form, true);

            return $this->redirectToRoute('supplier_list');
        }

        return $this->render('supplier/new.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/supplier/show/{id}", name="supplier_show", requirements={"id"="\d+"})
     *
     * @param int $id
     * @return Response
     */
    public function show(int $id): Response
    {
        return $this->render('supplier/show.html.twig', ['supplier' => $this->supplierFinder->get($id)]);
    }

    /**
     * @Route("/supplier/list", name="supplier_list")
     *
     * @return Response
     */
    public function list(): Response
    {
        return $this->render('supplier/list.html.twig', ['suppliers' => $this->supplierFinder->getAll()]);
    }

    /**
     * @Route("/supplier/edit/{id}", name="supplier_edit")
     *
     * @param Request $request
     * @param Supplier $supplier
     * @return Response
     */
    public function edit(Request $request, Supplier $supplier): Response
    {
        $form = $this->createForm(SupplierType::class, $supplier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->supplierManager->create($form);
        }

        return $this->render('supplier/edit.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/supplier/delete/{id}", name="supplier_delete")
     *
     * @param Supplier $supplier
     * @return Response
     */
    public function delete(Supplier $supplier): Response
    {
        $this->supplierManager->remove($supplier);

        return new Response($this->supplierFinder->countAll());
    }
}
