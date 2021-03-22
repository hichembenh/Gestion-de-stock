<?php

namespace App\Controller\Admin;

use App\Entity\CommandeGros;
use App\Form\CommandeGrosType;
use App\Repository\CommandeGrosRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommandeGrosController extends AbstractController
{
    /***
     * @var CommandeGrosRepository
     */
    private $commande;
    /**
     * @var EntityManagerInterface
     */
    private $manager;

    public function __construct(CommandeGrosRepository $commande,EntityManagerInterface $manager)
    {
        $this->commande=$commande;
        $this->manager = $manager;
    }

    /**
     * @return Response
     * @Route ("/CommandesGros",name="Admin.CommandeGros.index")
     */
    public function index(Request $request):Response
    {
        $commande = new CommandeGros();
        $form =$this->createForm(CommandeGrosType::class,$commande);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->manager->persist($commande);
            $this->manager->flush();
            $this->addFlash('success','Commande ajoutée avec succès');
        }
        $commandes = $this->commande->findAll();
        return $this->render('Dashboard/CommandeUnitaire/AdminOrder.html.twig',[
            'commande'=>$commande,
            'commandes'=>$commandes,
            'form'=>$form->createView(),
        ]);
    }
    /**
     * @Route ("/CommandesGros/{id}",name="Admin.CommandeGros.edit",methods="GET|POST")
     * @param $id
     * @param Request $request
     * @return Response
     */
    public function edit($id,Request $request)
    {
        $commande= $this->commande->find($id);
        $form =$this->createForm(CommandeGrosType::class,$commande);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $this->manager->flush();
            $this->addFlash('success','Commande modifiée avec succès');
            return $this->redirectToRoute('Admin.CommandeGros.index');
        }
        return $this->render("Dashboard/CommandeGros/EditerCommande.html.twig",[
            'commande'=>$commande,
            'form'=>$form->createView(),
        ]);
    }
    /**
     * @Route ("/CommandesGros/delete/{id}",name="Admin.CommandeGros.delete",methods="DELETE")
     * @param $id
     * @param Request $request
     * @return RedirectResponse
     */
    public function delete($id,Request $request){
        $commande= $this->commande->find($id);
        $this->manager->remove($commande);
        $this->manager->flush();
        $this->addFlash('success','Commande supprimée avec succès');

        return $this->redirectToRoute('Admin.CommandeGros.index');
    }
    /**
     * @Route ("/CommandeGrosList/new",name="Admin.CommandeGros.newCommand")
     * @param Request $request
     * @return Response
     */
    public function newCommand(Request $request):Response
    {
        $commandes = $this->commande->findAllNewCommande();
        return $this->render('Dashboard/CommandeGros/AdminNewOrder.html.twig',[
            'commandes'=>$commandes,
        ]);
    }
    /**
     * @Route ("/CommandeGrosList/confirmed",name="Admin.CommandeGros.confirmedCommand")
     * @param Request $request
     * @return Response
     */
    public function confirmedCommand(Request $request):Response
    {
        $commandes = $this->commande->findAllConfirmedCommande();
        return $this->render('Dashboard/CommandeGros/AdminNewOrder.html.twig',[
            'commandes'=>$commandes,
        ]);
    }
    /**
     * @Route ("/CommandeGrosList/sent",name="Admin.CommandeGros.sentCommand")
     * @param Request $request
     * @return Response
     */
    public function sentCommand(Request $request):Response
    {
        $commandes = $this->commande->findAllSentCommande();
        return $this->render('Dashboard/CommandeGros/AdminSentOrder.html.twig',[
            'commandes'=>$commandes,
        ]);
    }
}
