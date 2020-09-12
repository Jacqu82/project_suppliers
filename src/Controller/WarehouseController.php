<?php

declare(strict_types=1);

namespace App\Controller;

use App\Finder\WarehouseFinder;
use App\Form\WarehouseType;
use App\Manager\WarehouseManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @author Jacek Wesołowski <jacqu25@yahoo.com>
 */
class WarehouseController extends AbstractController
{
    private $warehouseManager;

    private $warehouseFinder;

    public function __construct(WarehouseManager $warehouseManager, WarehouseFinder $warehouseFinder)
    {
        $this->warehouseManager = $warehouseManager;
        $this->warehouseFinder = $warehouseFinder;
    }

    /**
     * @Route("/warehouse/new", name="warehouse_new")
     *
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $form = $this->createForm(WarehouseType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->warehouseManager->create($form, true);
        }

        return $this->render('warehouse/new.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/warehouse/show/{id}", name="warehouse_show")
     *
     * @param int $id
     * @return Response
     */
    public function show(int $id): Response
    {
        return $this->render('warehouse/show.html.twig', ['warehouse' => $this->warehouseFinder->get($id)]);
    }

    /**
     * @Route("/warehouse/list", name="warehouse_list")
     *
     * @return Response
     */
    public function list(): Response
    {
        return $this->render('warehouse/list.html.twig', ['warehouses' => $this->warehouseFinder->getAll()]);
    }
}
