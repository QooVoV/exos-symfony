<?php

namespace App\Controller\Front;

use App\Entity\Book;
use App\Repository\BookRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BookController extends AbstractController
{
    #[Route('/front/book/{id}', name: 'app_front_book')]
    public function detail(BookRepository $repository, Book $book): Response
    {
      $id = $book->getId();
      $book = $repository->find($id);

      return $this->render('front/book.html.twig', ['book'=>$book]);
    }
}
