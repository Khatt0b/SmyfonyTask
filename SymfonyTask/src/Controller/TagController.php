<?php

namespace App\Controller;

use App\Entity\Tag;
use App\Repository\TagRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/tag", name="tag")
 */
class TagController extends AbstractController
{
    /**
     * @Route("/", name="tag")
     */
    public function index(TagRepository $tagRepository): Response
    {
        $tag=$tagRepository->findAll();

        return $this->render('tag/index.html.twig',[
            "tags" => $tag
        ]);

    }

    /**
     * @Route("/show/{slug}", name="show")
     * @param Tag $tag
     * @return Response
     */
    public function show(Tag $tag){
        return $this->render("tag/show.html.twig",[
            'tag' => $tag
        ]);
    }
}
