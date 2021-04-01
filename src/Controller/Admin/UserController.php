<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @var UserRepository
     */
    private $user;
    /**
     * @var EntityManagerInterface
     */
    private $manager;
    /**
     * UserController constructor.
     * @param User $user
     * @param EntityManagerInterface $manager
     */
    public function __construct(UserRepository $user,EntityManagerInterface $manager)
    {
        $this->user = $user;
        $this->manager = $manager;
    }

    /**
     * @param Request $request
     * @return Response
     * @Route ("Super/new" , name="Admin.User.new")
     */
    public function registration(Request $request):Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class,$user);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->manager->persist($user);
            $this->manager->flush();
            $this->addFlash('success','Utilisateur ajoutée avec succès');
        }
        return $this->render('Dashboard/AdminNewUser.html.twig',[
            'form'=>$form->createView()
        ]);
    }
}
