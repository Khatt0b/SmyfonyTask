<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\AritcleFormType;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
/**
 * @Route("/article", name="article.")
 */
class ArticleController extends AbstractController
{
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
            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();
        }
        return $this->render('article/create.html.twig',[
            "aritcleForm" => $form->createView()
        ]);
    }
    /**
     * @Route("/show/{id}", name="show")
     */
    public function show(Article $article){
        return $this->render("article/show.html.twig",[
            'article' => $article
        ]);
    }
}
