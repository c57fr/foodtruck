<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CpanelController extends AbstractController
{
    /**
     * @Route("/admin/cpanel", name="admin_cpanel")
     */
    public function index(): Response
    {
        return $this->render('admin/cpanel/index.html.twig', [
            'controller_name' => 'CpanelController',
        ]);
    }
}
