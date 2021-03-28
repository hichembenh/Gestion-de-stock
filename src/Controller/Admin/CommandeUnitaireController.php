<?php

namespace App\Controller\Admin;

use App\Entity\CommandeUnitaire;
use App\Form\CommandeUnitaireType;
use App\Repository\CommandeUnitaireRepository;
use App\Repository\ArticlesFiniRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommandeUnitaireController extends AbstractController
{
    /***
     * @var CommandeUnitaireRepository
     */
    private $commande;
    /**
     * @var EntityManagerInterface
     */
    private $manager;

    /**
     * @var ArticlesFiniRepository
     */
    private $article;

    public function __construct(CommandeUnitaireRepository $commande, EntityManagerInterface $manager, ArticlesFiniRepository $article)
    {
        $this->commande = $commande;
        $this->article = $article;
        $this->manager = $manager;
    }

    /**
     * @return Response
     * @Route ("/Commandes",name="Admin.CommandeUnitaire.index")
     */
    public function index(Request $request): Response
    {
        $commande = new CommandeUnitaire();
        $form = $this->createForm(CommandeUnitaireType::class, $commande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $stock = $this->article->findOneBy(
                ['ref' => 'commande.ref']
            );
            $this->manager->persist($commande);
            $this->manager->flush();
            $this->addFlash('success', 'Commande ajoutée avec succès');
        }
        $commandes = $this->commande->findAll();
        return $this->render('Dashboard/CommandeUnitaire/AdminOrder.html.twig', [
            'commande' => $commande,
            'commandes' => $commandes,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route ("/Commandes/{id}",name="Admin.CommandeUnitarie.edit",methods="GET|POST")
     * @param $id
     * @param Request $request
     * @return Response
     */
    public function edit($id, Request $request)
    {
        $commande = $this->commande->find($id);
        $form = $this->createForm(CommandeUnitaireType::class, $commande);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->manager->flush();
            $this->addFlash('success', 'Commande modifiée avec succès');
            return $this->redirectToRoute('Admin.CommandeUnitaire.index');
        }
        return $this->render("Dashboard/CommandeUnitaire/EditerCommande.html.twig", [
            'commande' => $commande,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route ("/Commandes/delete/{id}",name="Admin.CommandeUnitaire.delete",methods="DELETE")
     * @param $id
     * @param Request $request
     * @return RedirectResponse
     */
    public function delete($id, Request $request)
    {
        $commande = $this->commande->find($id);
        $this->manager->remove($commande);
        $this->manager->flush();
        $this->addFlash('success', 'Commande supprimée avec succès');

        return $this->redirectToRoute('Admin.CommandeUnitaire.index');
    }
    /**
     * @Route ("/CommandeList/new",name="Admin.CommandeUnitaire.newCommand")
     * @param Request $request
     * @return Response
     */
    public function newCommand(Request $request): Response
    {
        $commandes = $this->commande->findAllNewCommande();
        return $this->render('Dashboard/CommandeUnitaire/AdminNewOrder.html.twig', [
            'commandes' => $commandes,
        ]);
    }
    /**
     * @Route ("/CommandeList/confirmed",name="Admin.CommandeUnitaire.confirmedCommand")
     * @param Request $request
     * @return Response
     */
    public function confirmedCommand(Request $request): Response
    {
        $commandes = $this->commande->findAllConfirmedCommande();
        return $this->render('Dashboard/CommandeUnitaire/AdminNewOrder.html.twig', [
            'commandes' => $commandes,
        ]);
    }
    /**
     * @Route ("/CommandeList/sent",name="Admin.CommandeUnitaire.sentCommand")
     * @param Request $request
     * @return Response
     */
    public function sentCommand(Request $request): Response
    {
        $commandes = $this->commande->findAllSentCommande();
        return $this->render('Dashboard/CommandeUnitaire/AdminSentOrder.html.twig', [
            'commandes' => $commandes,
        ]);
    }
}
