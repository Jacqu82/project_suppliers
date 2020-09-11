<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @author Jacek Wesołowski <jacqu25@yahoo.com>
 */
class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     *
     * @return Response
     */
    public function homepage(): Response
    {
        return $this->render('default/homepage.html.twig');
    }
}
