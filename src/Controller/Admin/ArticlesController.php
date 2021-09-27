<?php

namespace App\Controller\Admin;

use App\Entity\ArticleCaract;
use App\Entity\ArticlesFini;
use App\Form\ArticleCaractType;
use App\Form\ArticlesType;
use App\Repository\ArticlesFiniRepository;
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
    /**
     * @var ArticlesFiniRepository
     */
    private $article;

    public function __construct(EntityManagerInterface $manager, ArticlesFiniRepository $articles)
    {
        $this->article = $articles;
        $this->manager = $manager;
    }

    /**
     * @return Response
     * @Route("/articles", name="Stock.Articles")
     */
    public function index(Request $request): Response
    {
        $article = new ArticlesFini;
        $articleCaract = new ArticleCaract;
        $form = $this->createForm(ArticlesType::class, $article);
        $form->handleRequest($request);
        $articleCaract->setArticle($article);
        $formCaract = $this->createForm(ArticleCaractType::class,$articleCaract);
        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form->get('image')->getData();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            try {
                $file->move(
                    $this->getParameter('images_directory'),
                    $fileName
                );
            } catch (FileException $e) {}
            $article->setImage($fileName);
            $this->manager->persist($article);
            $this->manager->flush();
            $this->manager->persist($articleCaract);
            $this->manager->flush();
            $this->addFlash('success', 'Article ajoutée avec succès');
        }
        $articles= $this->article->findAll();
        return $this->render('Dashboard/Stock/Article/ArticleFini.html.twig', [
            'article' => $article,
            'form' => $form->createView(),
            'Caract'=>$formCaract->createView(),
            'articles' =>$articles
        ]);
    }
}
