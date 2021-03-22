<?php

namespace App\Controller\Admin;

use App\Entity\CommandeUnitaire;
use App\Repository\CommandeUnitaireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(CommandeUnitaireRepository $commandeUnitaire): Response
    {
        return $this->render('Dashboard\AdminIndex.html.twig');
    }
}
