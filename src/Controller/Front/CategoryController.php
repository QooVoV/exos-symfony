<?php

namespace App\Controller\Front;

use App\Entity\Category;
use App\Repository\BookRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategoryController extends AbstractController
{
    #[Route('/front/category/{id}', name: 'app_front_category')]
    public function display(BookRepository $repository,Category $category): Response
    {
        $id = $category->getId();
        $books = $repository->findAllByCategory($id);

        return $this->render('front/category.html.twig', ['books'=>$books, 'category'=>$category]);
    }
}
