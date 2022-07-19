<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Book;
use App\Form\BookType;
use App\Repository\BookRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BookController extends AbstractController
{
  
  #[Route('/admin/index', name : 'app_admin_index')]
  public function index(): Response {
    return $this->render('admin/index.html.twig');
  }
  
  // ______________________________________________________________

  #[Route('/admin/book/addNew', name : 'app_admin_book_addNew')]
  public function addNew(Request $request, BookRepository $repository): Response {

    // if($request->isMethod('POST')){

    //   $title = $request->request->get('title');
    //   $price = (float)$request->request->get('price');
    //   $description = $request->request->get('description');
    //   $imageUrl = $request->request->get('imageUrl');

    //   $book = new Book();

    //   $book->setTitle($title);
    //   $book->setPrice($price);
    //   $book->setDescription($description);
    //   $book->setImageUrl($imageUrl);

    //   $repository->add($book, true);

    //   return $this->redirectToRoute('app_admin_book_list');
    // }

    $form = $this->createForm(BookType::class);
      
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()){
      $bookValidated = $form->getData();

      $repository->add($bookValidated, true);

      return $this->redirectToRoute('app_admin_book_list');
    }
    
    $view = $form->createView();

    return $this->render('admin/book/addNew.html.twig', ['view'=>$view]);
  }

  // ______________________________________________________________

  #[Route('/admin/book/list', name : 'app_admin_book_list')]
  public function list(BookRepository $repository) : Response {

    $books = $repository->findAll();

    return $this->render('admin/book/list.html.twig', ['books'=>$books]);
  }

  // ______________________________________________________________

  #[Route('/admin/book/update/{id}', name : 'app_admin_book_update')]
  public function update(Request $request, BookRepository $repository, Book $book) : Response {

    // $book = $repository->find($id);

    // if($request->isMethod('POST')){

    //   $title = $request->request->get('name');
    //   $price = (float)$request->request->get('price');
    //   $description = $request->request->get('description');
    //   $imageUrl = $request->request->get('imageUrl');

    //   $book->setTitle($title);
    //   $book->setPrice($price);
    //   $book->setDescription($description);
    //   $book->setImageUrl($imageUrl);

    //   $repository->add($book, true);

    //   return $this->redirectToRoute('app_admin_book_list');
    // }

    $form = $this->createForm(BookType::class, $book);

    $form->handleRequest($request);

      if ($form->isSubmitted() && $form->isValid()){
        $book= $form->getData();

        $repository->add($book, true);

        return $this->redirectToRoute('app_admin_book_list');
      }
      
      $view = $form->createView();

    return $this->render('admin/book/update.html.twig', ['book'=>$book, 'view'=>$view]);
  }

  // ______________________________________________________________

  #[Route('/admin/book/delete/{id}', name : 'app_admin_book_delete')]
  public function delete(BookRepository $repository, int $id) : Response {

    $book = $repository->find($id);

    $repository->remove($book, true);

    return $this->redirectToRoute('app_admin_book_list');
  }


}
