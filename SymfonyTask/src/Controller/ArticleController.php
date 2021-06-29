<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\AritcleFormType;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

/**
 * @Route("/article", name="article.")
 */
class ArticleController extends AbstractController
{
    private $security;

    public function __construct(Security $security)
    {
        // Avoid calling getUser() in the constructor: auth may not
        // be complete yet. Instead, store the entire Security object.
        $this->security = $security;
    }
    /**
     * @Route("/", name="article")
     */
    public function index(ArticleRepository $articleRepository): Response
    {
    $articles=$articleRepository->findAll();

    return $this->render('article/index.html.twig',[
        "aritcles" => $articles
    ]);

    }
    /**
     * @Route("/create", name="create")
     */
    public function createArticle(Request $request): Response
    {
        $article = new Article();
        $form = $this->createForm(AritcleFormType::class,$article);
        $form->handleRequest($request);
        if($form->isSubmitted()){
            $article->setAuthor($this->security->getUser());
            $article->setSlug(strtolower(preg_replace('/\s+/', '_', $article->getTitle())));
            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();
        }
        return $this->render('article/create.html.twig',[
            "aritcleForm" => $form->createView()
        ]);
    }
    /**
     * @Route("/show/{slug}", name="show")
     */
    public function show(Article $article){
        return $this->render("article/show.html.twig",[
            'article' => $article
        ]);
    }

}
