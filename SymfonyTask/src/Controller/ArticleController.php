<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\AritcleFormType;
use App\Repository\ArticleRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
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
     * @IsGranted("ROLE_USER")
     */
    public function createArticle(Request $request): Response
    {
        $article = new Article();
        $form = $this->createForm(AritcleFormType::class,$article);
        $form->handleRequest($request);
        if($form->isSubmitted()){
            $article->setAuthor($this->security->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();
            return $this->redirectToRoute('home.home');
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
    /**
     * @Route("/delete/{slug}", name="delete")
     * @IsGranted("ARTICLE_DELETE",subject="article")
     */
    public function delete(Article $article){

           $em=$this->getDoctrine()->getManager();
           $em->remove($article);
           $em->flush();

           return $this->redirect($this->generateUrl("article.article"));
    }

    /**
     * @Route("/edit/{slug}", name="edit")
     * @IsGranted("ARTICLE_EDIT",subject="article")
     */
    public function edit(Article $article,Request $request)
    {
            $form = $this->createForm(AritcleFormType::class, $article);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                /** @var Article $article */
                $article = $form->getData();
                $em = $this->getDoctrine()->getManager();
                $em->persist($article);
                $em->flush();
                $this->addFlash('success', 'Article Created! Knowledge is power!');
                return $this->redirectToRoute('article.article');
            }
            return $this->render('article/edit.html.twig', [
                'aritcleForm' => $form->createView()
            ]);

    }
}
