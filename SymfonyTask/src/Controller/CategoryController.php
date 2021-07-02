<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryFormType;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
/**
 * @Route("/category", name="category.")
 */
class CategoryController extends AbstractController
{
    /**
     * @Route("/", name="category")
     */
    public function index(CategoryRepository $categoryRepository): Response
    {
        $category=$categoryRepository->findAll();

        return $this->render('category/index.html.twig',[
            "categories" => $category
        ]);

    }
    /**
     * @Route("/create", name="create")
     */
    public function createCategory(Request $request): Response
    {
        $category = new Category();
        $form = $this->createForm(CategoryFormType::class,$category);
        $form->handleRequest($request);
        if($form->isSubmitted()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();
        }
        return $this->render('category/create.html.twig',[
            "categoryForm" => $form->createView()
        ]);
    }
    /**
     * @Route("/show/{slug}", name="show")
     */
    public function show(Category $category){
        return $this->render("category/show.html.twig",[
            'category' => $category
        ]);
    }

}
