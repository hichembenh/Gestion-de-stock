<?php

namespace App\Controller\Admin;

use App\Entity\ArticlesFini;
use App\Form\ArticlesType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ArticlesController extends AbstractController
{

    /**
     * @var EntityManagerInterface
     */
    private $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @return Response
     * @Route("/articles", name="Stock.Articles")
     */
    public function index(Request $request): Response
    {
        $article = new ArticlesFini;
        $form = $this->createForm(ArticlesType::class, $article);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->manager->persist($article);
            $this->manager->flush();
            $this->addFlash('success', 'Article ajoutée avec succès');
        }
        return $this->render('Dashboard/Stock/Article/ArticleFini.html.twig', [
            'article' => $article,
            'form' => $form->createView(),
        ]);
    }
}
