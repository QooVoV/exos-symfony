<?php

namespace App\Controller\Front;

use App\Repository\BookRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/front/home', name: 'app_front_home')]
    public function home(BookRepository $repository): Response
    {
      $books = $repository->findAllByPrice();

      return $this->render('front/home.html.twig', ['books'=>$books]);
    }
}
